<?php 
function add_bm($new_url){
    echo "Attempting to add ".htmlspecialchars($new_url)."<br />";
    $valid_user = $_SESSION['valid_user'];
    $conn = db_connect();
    $result = $conn -> query("select * from bookmark where username='".$valid_user."'and bm_URL='".$new_url."'");
    if($result && ($result -> num_rows > 0))
        throw new Exception('Bookmark already exists.');
    if(!$conn -> query("insert into bookmark values('".$valid_user."','".$new_url."')"))
        throw new Exception('Bookmark could not be inserted.');
    return true;
}

function get_user_urls($username){
    $conn = db_connect();
    $result = $conn -> query("select bm_URL from bookmark where username = '".$username."'");
    if(!$result)
        return false;
    $url_array = array();
    for($count = 1;$row = $result -> fetch_row(); ++$count)
        $url_array[$count] = $row;
    return $url_array;
}

function delete_bm($user,$url){
    $conn = db_connect();
    if(!$conn -> query("delete from bookmark where username='".$user."'and bm_url='".$url."'"))
        throw new Exception('Bookmark could not be deleted');
    return true;
}

function recommend_urls($valid_user,$popularity = 1){
    $query = "select bm_URL from bookmark where username in (
                select distinct(b2.username) 
                from bookmark b1, bookmark b2
                where b1.username ='".$valid_user."'
                and b1.username != b2.username 
                and b1.bm_URL = b2.bm_URL)
            and bm_URL not in (
                select bm_URL from bookmark where username='".$valid_user."')
            group by bm_url having count(bm_url) > ".$popularity;
    $conn = db_connect();
    if(!($result = $conn -> query($query)))
        throw new Exception('Could not find any bookmarks to recommend.');
    if($result -> num_rows == 0)
        throw new Exception('Could not find any bookmarks to remcommend.');
    $urls = array();
    for($count=0; $row = $result->fetch_object();$count++)
        $urls[$count] = $rows -> bm_URL;
    return $urls;
}
?>
bool containsDuplicate(int* nums, int numsSize){
    int i,j,temp,step;
    for(step =numsSize/2;step>0;step/=2){
        for(i=step;i<numsSize;i++){
            temp=nums[i];
            for(j = i - step;j>=0&&temp<nums[j];j-=step){
                nums[j+step] = nums[j];
            }
            nums[j+step]=temp;
        }
    }
    int k =0;
    while(k<numsSize-1){
        if(nums[k] == nums[k+1])
            return true;
        k++;
    }
    return false;
}

//时间 152 ms 内存 12.1 MB
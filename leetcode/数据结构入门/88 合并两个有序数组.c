int* quickstart(int* nums,int left,int right){
    if(left < right){
        int key = partition(nums,left,right);
        quickstart(nums,left,key - 1);
        quickstart(nums,key + 1,right);
    }
    return nums;
}

int partition(int *nums,int left,int right){
    int key = nums[left];
    while(left < right){
        while(left < right && nums[right] >= key){
            right--;
        }
        nums[left] = nums[right];
        while(left < right && nums[left] <= key){
            left++;
        }
        nums[right] = nums[left];
    }
    nums[left] = key;
    return left;
}
void merge(int* nums1, int nums1Size, int m, int* nums2, int nums2Size, int n){
    int i=0;
    while(i<n){
        nums1[m+i] = nums2[i];
        i++;
    }
    nums1 = quickstart(nums1,0,m+n-1);
}

int maxSubArray(int* nums, int numsSize){
    int MaxSum = nums[0];
    int sum = 0;
    for (int i = 0;i<numsSize;i++){
        sum = sum + nums[i];
        if (sum > MaxSum)
            MaxSum = sum;
        if(sum < 0)
            sum = 0;
    }
    return MaxSum;
}
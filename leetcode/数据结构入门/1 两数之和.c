int* twoSum(int* nums, int numsSize, int target, int* returnSize){
    *returnSize = 2;
    int* ret = (int*)malloc(sizeof(int)*2);
    ret[0] = ret[1] = 0;
    int tempnum,i,j =  0;
    for (int j = 0;j<numsSize-1;j++)
    {
        i=j+1;
        tempnum = nums[j];
        while(i<numsSize)
        {
            if(tempnum > target )
            {
                if(nums[i]>0)
                {
                    i++;
                    continue;
                }
                else
                {
                    if(nums[i]+tempnum==target)
                    {
                        ret[0] = j;
                        ret[1] = i;
                        return  ret;
                    }
                    else
                    {
                        i++;
                        continue;                       
                    }
                }
            }
            else
            {
                if(nums[i]<0)
                {
                    i++;
                    continue;
                }
                else
                {
                    if(nums[i]+tempnum==target)
                    {
                        ret[0] = j;
                        ret[1] = i;
                        return ret;
                    }
                    else
                    {
                        i++;
                        continue;                       
                    }
                }
            }
        }
    }
    return ret;
}
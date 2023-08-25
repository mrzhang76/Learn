int maxProfit(int* prices, int pricesSize){
    int low = prices[0],profit = 0;
    int i = 0;
    while (i < pricesSize){
        if(low > prices[i])
            low = prices[i];
        if(profit < prices[i] - low)
            profit = prices[i] -low;
        i++;
    }
    return profit;
    
}
//贪心算法 动态规划 
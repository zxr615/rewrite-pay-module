## 使用策略模式和简单工厂模式重写支付模块

### 文章地址

[https://learnku.com/articles/55410](https://learnku.com/articles/55410)

### 测试

1. 启动服务

    ```console
    php artisan serve
    ```

2. 请求

   创建临时订单

    ```console
    curl http://127.0.0.1:8000/buy/vip?code=buy_vip&buy_month=5
    ```

   预览订单

    ```console
    curl http://127.0.0.1:8000/buy/preview?key=零时订单key
    ```

3. 支付

   没有完全实现



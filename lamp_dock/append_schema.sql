//注文履歴登録
CREATE TABLE history (
    'order_id' int(11) NOT NULL AUTO_INCREMENT,
    'user_id' int(11) NOT NULL,
    'datetime' datetime
);

//注文明細
CREATE TABLE details (
    'order_id' int(11) NOT NULL,
    'item_id' int(11) NOT NULL,
    'amount' int(11) NOT NULL,
    'price'  int(11) NOT NULL,
    'datetime' datetime 
);



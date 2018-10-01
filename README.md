# Home Blackboard
---

## 食用方法

+ 创建一个 mysql 数据库，执行如下 SQL 语句
```
CREATE TABLE `days_matter` (
  `id` int(11) NOT NULL,
  `timestamp` int(13) NOT NULL,
  `content` text NOT NULL,
  `edit_timestamp` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `timestamp` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `days_matter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```
+ 在 `config/config.php` 里填入数据库信息，如：
```
define ('DATABASE_HOST', '127.0.0.1');
define ('DATABASE_NAME', 'home');
define ('DATABASE_USERNAME', 'root');
define ('DATABASE_PASSWORD', 'root');
```
+ 访问 ```/day``` 可编辑倒计时
+ 访问 ```/note``` 可编辑笔记
+ Raspberry Pi 设置主页为 ```/home```
+ Enjoy it!

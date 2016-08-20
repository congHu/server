# server
服务器地址：http://119.29.225.180/notecloud/
## 注册新用户
请求 |方法|返回数据
---|---|---
register.php| POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
email | 邮箱地址| 务必有"@"符号
password | 密码 |务必6位以上
verify | 验证码 |
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
uid | 用户ID| 整数Int
activecode | 用户识别码 |随机字符串String

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 103| 验证码错误
error | 111| 用户已注册

## 登陆
请求 |方法|返回数据
---|---|---
login.php| POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
email | 邮箱地址| 务必有"@"符号
password | 密码 |务必6位以上
verify | 验证码 |可选*
- [*]根据isRequireValidCode.php的结果决定，参考下一节内容
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
uid | 用户ID| 整数Int
isActive | 用户是否激活| "0"或"1"
activecode | 用户识别码 |随机字符串String

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 102| 密码错误
error | 103| 验证码错误

## 是否需要验证码
请求 |方法|返回数据
---|---|---
isRequireValidCode.php| GET|"0"或"1"

#### 请求参数
- 无
#### 返回数据
- 成功

内容 | 注释 |
---|---
 "0"| 登陆时不需要验证码
"1" |登陆时需要验证码

## 获取验证码图片
请求 |方法|返回数据
---|---|---
captcha.php| GET|image/png

#### 请求参数
- 无
#### 返回数据
- 成功

内容 | 注释 |
---|---
png图片| 130x50像素

## 获取头像
请求 |方法|返回数据
---|---|---
getAvatar.php| GET|JSON或image/jpg

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid | 用户ID| 整数Int
type | 类型 |"user"为用户, "group"为群聊
#### 返回数据
- 成功

内容 | 注释 |
---|---
 图片jpg| 头像

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在

## 获取用户信息
请求 |方法|返回数据
---|---|---
getUserInfo.php| GET|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid | 用户ID| 整数Int
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
uname | 用户名| String
gender | 性别 |"0"男, "1"女 可能为null
area | 地区 |String 可能为null
description|个性签名|String 可能为null
age_privacy|生日隐私|"0"显示生日,"1"不显示,"2"显示年龄
birthday|生日|String "yyyy-MM-dd" 可能不存在该键
age|年龄|可能不存在该键

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在

## 设置用户信息
请求 |方法|返回数据
---|---|---
setAttr.php| POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid | 用户ID| 整数Int
acode | 用户识别码| [*]随机字符串String
attr | 要设置的属性名|[**]属性名String
value | 属性的值| String
- [*]登陆或注册时获得
- [**] 属性名与属性值如下表

属性名|内容|注释
---|---|---
uname|用户名|String,10字限制
gender|性别|"0"男,"1"女
area|国家,地区|String
description|个性签名|String,60字限制
birthday|生日|String,"yyyy-MM-dd"
age_privacy|生日隐私|"0"显示生日,"1"不显示,"2"显示年龄
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
success|200|成功

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 171| 识别码不正确
error | 862| 属性名不对，或者属性值格式不对

## 搜索好友
请求 |方法|返回数据
---|---|---
searchFriend.php | GET|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
input|关键字|String
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
_|数组<键值对>|

- 键值对

参数名 | 内容 | 注释 |
---|---|---
uid|用户ID|Int
uname|用户名|String
gender | 性别 |"0"男, "1"女 可能为null
area | 地区 |String 可能为null
age|年龄|可能不存在该键


## 发送好友邀请
请求 |方法|返回数据
---|---|---
sendFriendReq.php | POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid|甲方用户ID|Int
acode|甲方用户识别码|随机String
toid|乙方用户ID|Int
msg|验证信息|String

#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
success|200|成功
- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 174| 识别码不正确
error | 423| 已经是好友


## 确认添加好友
请求 |方法|返回数据
---|---|---
addFriend.php | POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid|甲方用户ID|Int
acode|甲方用户识别码|随机String
fid|乙方用户ID|Int

#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
success|200|成功

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 174| 识别码不正确
error | 423| 不是好友

## 是否为好友
请求 |方法|返回数据
---|---|---
isFriend.php | POST|"0"或"1"

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid|甲方用户ID|Int
acode|甲方用户识别码|随机String
fid|乙方用户ID|Int
#### 返回数据
- 成功

内容 | 注释 |
---|---
"0"|甲和乙是好友
"1"|甲和乙不是好友

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 174| 识别码不正确

## 收取消息
请求 |方法|返回数据
---|---|---
fetchMsg.php | POST|JSON

- 注: 需要定期请求

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid|甲方用户ID|Int
acode|甲方用户识别码|随机String
#### 返回数据
- 成功

参数名|内容 | 注释 |
---|---|---
_|数组<键值对>|

- 键值对的内容

参数名|内容 | 注释 |
---|---|---
send_from|来自哪里|"user"来自用户; "groupX"来自群聊, 其中"X"表示群聊ID
from_id|来自ID|发送方用户ID, 也用来辨识群聊中的发送方用户
type|消息类型|看下表
body|消息主体|也是看下表
chatname|聊天室标题|用户名或者备注名或者群聊名

- type和body

type|body|注释
---|---|---
string|String|文字
image|xxxx.jpg|图片
voice||语音
video|xxxx.mp4|视频
location||位置
req|String|好友请求

- *2016-07-20 目前只支持文字信息
- *2016-07-20 目前不支持群聊

- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 174| 识别码不正确

## 单对单发送文字消息
请求 |方法|返回数据
---|---|---
sendMsg.php | POST|JSON

#### 请求参数
参数名 | 内容 | 注释 |
---|---|---
uid|甲方用户ID|Int
acode|甲方用户识别码|随机String
toid|乙方用户ID|Int
body|消息内容|String
#### 返回数据
- 成功

参数名 | 内容 | 注释 |
---|---|---
success|200|成功
- 错误

参数名 | 内容 | 注释 |
---|---|---
error | 101| 用户不存在
error | 174| 识别码不正确
error | 423| 不是好友
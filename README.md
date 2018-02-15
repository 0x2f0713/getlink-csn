# Get Link Chia Sẻ Nhạc

## Yêu cầu
* Hosting phải có chứng chỉ SSL (khi dụng cùng với Dropbox)
* Ngoài ra không có yêu cầu gì thêm. :v
## Tính năng
* Get link download từ một link nhạc cụ thể (Get_file.php)
* Get link download khi tìm kiếm bài hát (Get_link.php)
* Get link download từ album (Get_Album.php)
* Gửi bài hát đến chatbot (page sử dụng ChatFuel) (Chatbot.php)
* Gửi tên bài hát đến chatbot (page sử dụng ChatFuel) (Chatbot_filename.php)
## Sử dụng
Đơn giản lắm, chỉ việc down về và xài thôi hoặc dùng lệnh:
```
git clone https://github.com/0x2f0713/get_link_chiasenhac.git
```
![alt text](https://i.imgur.com/xUcuUgn.png)

Bạn nên giữ nguyên cấu trúc thư mục để dễ sử dụng nhé.
## Các chuỗi truy vấn
### File Get_file.php

| Chuỗi truy vấn        | Giá trị          |
| ------------- |:-------------:|
| url      | Đường dẫn đến bài hát trên Chia Sẻ Nhạc (VD: http://m2.chiasenhac.vn/mp3/beat-playback/us-instrumental/byte~martin-garrix-brooks~tsvq03srqenw4a.html) |
### File Get_link.php
| Chuỗi truy vấn        | Giá trị          |
| ------------- |:-------------:|
| page      | Số nguyên dương |
| category      | Chuyên mục tìm. Giá trị: video (Video), playback (Playback), music (Nhạc). Mặc định: '' (Tất cả) |
| order      | Thứ tự sắp xếp. Giá trị: quality (Chất lượng), time (Thời gian). Mặc định: '' (Được yêu thích) |
| mode      | Tìm theo. Giá trị: artist (Ca sĩ), composer (Sáng tác), album (Tên Album), lyric (Lời bài hát). Mặc định: '' (Tên bài hát/ca sĩ) |
### File Get_Album.php
| Chuỗi truy vấn        | Giá trị          |
| ------------- |:-------------:|
| url      | Đường dẫn đến album trên Chia Sẻ Nhạc (VD: http://chiasenhac.vn/nghe-album/festival-of-lights~kshmr-maurice-west~tsvd6c05qmkvnh.html) |
### File Chatbot.php
| Chuỗi truy vấn        | Giá trị          |
| ------------- |:-------------:|
| data      | Từ khóa tìm kiếm. VD: data=Byte để tìm bài hát Byte của Martin Garrix. Nó sẽ lấy kết quả đầu tiên. |
> Trong file có phần mình chưa điền như trong ô màu đỏ. Cái này mình sẽ chỉ ở bên dưới

![alt text](https://i.imgur.com/KOLX54K.png)
### File Chatbot_filename.php
| Chuỗi truy vấn        | Giá trị          |
| ------------- |:-------------:|
| data      | Từ khóa tìm kiếm. VD: data=Byte để tìm bài hát Byte của Martin Garrix. Nó sẽ lấy kết quả đầu tiên. |

Cái này không có tác dụng gì quan trọng nên bạn có thể bỏ đi cũng được. Nếu bạn cần lấy tên và người sáng tác bài hát, bạn sẽ cần đến nó.
### Các file và thư mục còn lại
#### File dropbox.php
Đây là file test upload file và lấy link truy cập trực tiếp (download) tạm thời của Dropbox.
#### File simple_html_dom.php
Thư viện giúp bóc tách dữ liệu từ trang khác, giúp mình lấy được link download và tên bài hát. Cái này bạn lên Google tìm nhé.
### Thư mục vendor
Chứa Dropbox SDK (chưa chính thức) và một số thư viện đi kèm.

> Còn về cái App Key, App Secret, AccessToken thì để sau vì nó khá dài, đi chơi Tết đã.

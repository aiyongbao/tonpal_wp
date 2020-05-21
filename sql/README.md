### sql加密
tar -zcf - install-db.sql |openssl des3 -salt -k 加密密钥 | dd of=install-db.sql.des3
### sql解密
dd if=install-db.sql.des3 |openssl des3 -d -k 加密密钥 | tar zxf -
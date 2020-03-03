### sql加密
tar -zcf - init-wp.sql |openssl des3 -salt -k 加密密钥 | dd of=init-wp.sql.des3
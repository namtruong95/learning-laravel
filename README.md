# linting

```
./vendor/bin/phpcs ./app/
```

```
Token: mZCBgfULzm4gE8DSCaH_1kYPG8GRT1ZX7SgAimvM5-c
Your user Id: gyiwzTW6bYYXCRBdu
url: https://neolab.wc.calling.fun/api

```

curl -H "X-Auth-Token: mZCBgfULzm4gE8DSCaH_1kYPG8GRT1ZX7SgAimvM5-c" \
 -H "X-User-Id: gyiwzTW6bYYXCRBdu" \
 -H "Content-type:application/json" \
 https://neolab.wc.calling.fun/api/v1/chat.sendMessage \
 -d '{"message": { "rid": "mm8fD4nGvWRX9Fhpr", "msg": "This is a test!" }}'

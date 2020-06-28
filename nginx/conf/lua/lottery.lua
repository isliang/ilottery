local mysql = require "resty.mysql"
local db, err = mysql:new()
if not db then
    ngx.say("failed to instantiate mysql: ", err)
    return
end

db:set_timeout(1000) -- 1 sec

local ok, err, errcode, sqlstate = db:connect{
    host = "127.0.0.1",
    port = 3306,
    database = "lottery_db",
    user = "root",
    password = "centos",
    charset = "utf8",
    max_packet_size = 1024 * 1024,
}

if not ok then
    ngx.say("failed to connect: ", err, ": ", errcode, " ", sqlstate)
    return
end

ngx.say("connected to mysql.")

res, err, errcode, sqlstate =
db:query("select * from lottery where red = " + arg["red"] + " and blue = " + arg["blue"])
if not res then
    ngx.say("bad result: ", err, ": ", errcode, ": ", sqlstate, ".")
    return
end

local cjson = require "cjson"
local result = {code=200,list=res}
ngx.say("", cjson.encode(result))

local ok, err = db:set_keepalive(10000, 100)
if not ok then
    ngx.say("failed to set keepalive: ", err)
    return
end

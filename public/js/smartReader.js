var PROTOCEL_FLAG = {
    _reader_cmd_STX: 165, //命令头
    _reader_cmd_ETX: 213, //命令尾
}

/**
 * 读写器命令
 */
var READER_CMD = {
    _reader_server_connect: 5, //读写器服务连接
    _reader_server_close: 6, //读写器服务断开连接
    _reader_cmd_connect: 10, //连接读写器
    _reader_cmd_disconnect: 11, // 关闭读写器
    _reader_cmd_read_ver: 12, // 读取硬件版本号
    _reader_cmd_read_snr: 13, // 读取序列号
    _reader_cmd_beep: 14, //读写器鸣响
    _reader_cmd_set_baud: 15, //设置串口波特率
    _reader_cmd_get_status: 16, //获取大卡座是否有卡
    _reader_cmd_write_eeprom: 17, //写eeprom
    _reader_cmd_read_eeprom: 18, //读eeprom
    _reader_cmd_set_number: 19, //设置读写器编号
    _reader_cmd_get_number: 20, //获取读写编号
    _reader_cmd_turn_on: 21, //接触式卡座上电
    _reader_cmd_turn_off: 22, //接触式卡座下电
    _reader_cmd_rf_reset: 23, //射频头复位
    _reader_cmd_select_protocol: 24, //选择协议

    _reader_cmd_rf_card: 50, // 寻卡 TypeA
    _reader_cmd_rf_halt: 51, // 停止卡 TypeA
    _reader_cmd_rf_card_b: 52, // 寻卡 TypeB
    _reader_cmd_rf_halt_b: 53, // 停止卡 TypeB
    _reader_cmd_m_auth_key: 54, //S50/S70校验密码
    _reader_cmd_m_write: 55, //s50/s70写数据
    _reader_cmd_m_read: 56, //s50/s70读数据
    _reader_cmd_m_init_value: 57, //s50/s70初始化值
    _reader_cmd_m_read_value: 58, //s50/s70读值
    _reader_cmd_m_increment_value: 59, //s50/s70加值
    _reader_cmd_m_decrement_value: 60, //s50/s70减值

    _reader_cmd_c_cpu_reset: 65, //非接cpu卡复位TypeA
    _reader_cmd_c_cpu_reset_b: 66, //非接cpu卡复位TypeB
    _reader_cmd_c_cpu_Transmit: 67, //非接cpu发送指令TypeA/B

    _reader_cmd_uc_auth_key: 70, //ultralight C 校验密码
    _reader_cmd_uev_auth_key: 71, //ultralight EV 校验密码
    _reader_cmd_u_read: 72, //读ultralight/C数据
    _reader_cmd_u_write: 73, //写ultralight/C数据
    _reader_cmd_uc_change_key: 74, //更改ultralight C密码

    _reader_cmd_ntag_auth_pwd: 80, //校验ntag密码
    _reader_cmd_ntag_read: 81, //读ntag数据
    _reader_cmd_ntag_write: 82, //写ntag数据
    _reader_cmd_ntag_counter: 83, //读ntag中nfc单向计数器的值
    _reader_cmd_ntag_version: 84, //读ntag版本信息
    _reader_cmd_ntag_sig: 85, //读取ntag签名信息

    _reader_cmd_icode2_set_mode: 100, //设置数据交换模式
    _reader_cmd_icode2_inventory: 101, // ICode2卡执行防冲突操作,返回卡的 DSFID 和 UID
    _reader_cmd_icode2_select: 102, //设置ICode2卡为选择状态.
    _reader_cmd_icode2_reset_to_ready: 103, //使ICode2卡进入 Ready 状态
    _reader_cmd_icode2_to_quiet: 104, //使ICode2卡进入 Quiet 状态
    _reader_cmd_icode2_read: 105, //读取ICode2多个块信息
    _reader_cmd_icode2_write: 106, //写入ICode2多个块信息
    _reader_cmd_icode2_write_afi: 107, //写AFI(应用标识)
    _reader_cmd_icode2_write_dsfid: 108, //写DSFID(数据存储标识)
    _reader_cmd_icode2_set_eas: 109, //设置EAS
    _reader_cmd_icode2_lock: 110, //锁定数据块
    _reader_cmd_icode2_lock_afi: 111, //锁定AFI
    _reader_cmd_icode2_lock_dsfid: 112, //锁定DSFID
    _reader_cmd_icode2_lock_eas: 113, //锁定EAS
    _reader_cmd_icode2_get_mulblock_security: 114, //读取ICode2的多个块的安全状态信息
    _reader_cmd_icode2_get_sysinfo: 115, //获取ICode2系统信息

    _reader_cmd_uhf_inventory: 120, //查找标签
    _reader_cmd_uhf_select_mode: 121, //设置选择模式
    _reader_cmd_uhf_select: 122, //选择标签
    _reader_cmd_uhf_read: 123, //读标签数据存储区
    _reader_cmd_uhf_write: 124, //写标签数据存储区
    _reader_cmd_uhf_lock_unlock: 125, //锁定或解锁数据存储区
    _reader_cmd_uhf_kill: 126, //灭活标签
    _reader_cmd_uhf_set_region: 127, //设置读写器工作地区
    _reader_cmd_uhf_set_channel: 128, //设置工作信道
    _reader_cmd_uhf_get_channel: 129, //获取工作信道
    _reader_cmd_uhf_set_hfss: 130, //设置自动跳频
    _reader_cmd_uhf_set_papower: 131, //设置发射功率
    _reader_cmd_uhf_get_papower: 132, //获取发射功率
    _reader_cmd_uhf_set_cw: 133, //设置发射连续载波
    _reader_cmd_uhf_set_modem: 134, //设置读写器接收解调器参数
    _reader_cmd_uhf_get_modem: 135, //获取读写器接收解调器参数

    _reader_cmd_lf_set_datarate: 150, //设置接收频率
    _reader_cmd_lf_open_mod: 151, //打开 125KHz 射频信号
    _reader_cmd_lf_close_mod: 152, //关闭 125KHz 射频信号
    _reader_cmd_t5557_write_free: 153, //向射频卡中写入数据(不加密)
    _reader_cmd_t5557_write_pwd: 154, //向射频卡中写入数据(加密)
    _reader_cmd_t5557_read_direct: 155, //读取T5557卡中指定数据页指定数据区的数据
    _reader_cmd_t5557_aor: 156, //使用密码唤醒 AOR 模式进行读加密的T5557射频卡 
    _reader_cmd_t5557_to_id: 157, //将 T5557 卡转换成 ID 卡
    _reader_cmd_id_restore_t5557: 158, //将转换成的 ID 卡还原成 T5557 卡
    _reader_cmd_em_read: 159, //读取EM4001或兼容 ID 卡数据
    _reader_cmd_em4305_write: 160, //向 EM4305 卡指定地址写入数据
    _reader_cmd_em4305_read_biphase: 161, //读取 EM4305 卡指定地址的数据
    _reader_cmd_em4305_read_manchester: 162, //读取 EM4305 卡指定地址的数据
    _reader_cmd_em4305_login: 163, //验证 EM4305 卡密码
    _reader_cmd_em4305_protect: 164, //锁定 EM4305 卡指定地址
    _reader_cmd_em4305_disable: 165, //休眠 EM4305 卡 
    _reader_cmd_em4305_set_mode: 166, //设置EM卡类型
    _reader_cmd_em4305_to_id: 167, //把 EM4305 格式化成 ID 卡
    _reader_cmd_em4305_to_fdxb: 168, //把 EM4305 格式化成 FDX_B 卡

    _reader_cmd_cpu_reset: 200, //接触cpu复位
    _reader_cmd_cpu_transmit: 201, //接触cpu发送命令
    _reader_cmd_cpu_set_baud: 202, //设置接触cpu波特率

    _reader_cmd_24c_write: 205, //写24c系列卡片
    _reader_cmd_24c_read: 206, //读24c系列卡片
    _reader_cmd_45D041_write: 207, //写45D041卡
    _reader_cmd_45D041_read: 208, //读45D041卡

    _reader_cmd_4442_read: 210, //读SLE4442卡
    _reader_cmd_4442_write: 211, //写SLE4442卡
    _reader_cmd_4442_verify_sc: 212, //验证SLE4442卡密码
    _reader_cmd_4442_change_sc: 213, //更改SLE4442卡密码
    _reader_cmd_4442_read_sc: 214, //读SLE4442卡密码
    _reader_cmd_4442_read_counter: 215, //读取错误计数
    _reader_cmd_4442_read_pro_bit: 216, //读保护位
    _reader_cmd_4442_protect: 217, //保护数据

    _reader_cmd_4428_read: 220, //读SLE4428卡
    _reader_cmd_4428_write: 221, //写SLE4428卡
    _reader_cmd_4428_verify_sc: 222, //验证SLE4428卡密码
    _reader_cmd_4428_change_sc: 223, //更改SLE4428卡密码
    _reader_cmd_4428_read_sc: 224, //读SLE4428卡密码
    _reader_cmd_4428_read_counter: 225, //读取错误计数
    _reader_cmd_4428_read_pro: 226, //带保护位读
    _reader_cmd_4428_write_pro: 227, //写数据并保护
    _reader_cmd_4428_protect: 228, //保护数据

    _reader_cmd_102_read: 230, //读102卡
    _reader_cmd_102_write: 231, //写102卡
    _reader_cmd_102_erase: 232, //擦除数据
    _reader_cmd_102_verify_sc: 233, //验证用户密码
    _reader_cmd_102_change_sc: 234, //更改用户密码
    _reader_cmd_102_read_sc: 235, //读取用户密码
    _reader_cmd_102_read_sc_counter: 236, //读取用户密码错误计数器
    _reader_cmd_102_verify_erase_key: 237, //校验擦除密码
    _reader_cmd_102_change_erase_key: 238, //更改擦除密码
    _reader_cmd_102_read_erase_key: 239, //读取擦除密码
    _reader_cmd_102_read_erase_counter: 240, //读取应用二区擦除计数
    _reader_cmd_102_PR_RD_clear: 241, //读写属性控制位清零
    _reader_cmd_102_simulate_psnl: 242, //模拟个人化
    _reader_cmd_102_psnl: 243, //个人化

    _reader_cmd_1604_read: 250, //读1604卡
    _reader_cmd_1604_write: 251, //写1604卡
    _reader_cmd_1604_erase: 252, //擦除数据
    _reader_cmd_1604_verify_sc: 253, //验证密码
    _reader_cmd_1604_change_sc: 254, //更改密码
    _reader_cmd_1604_read_sc: 255, //读取密码
    _reader_cmd_1604_read_sc_counter: 256, //读取密码错误计数
    _reader_cmd_1604_verify_erase_key: 257, //验证擦除密码
    _reader_cmd_1604_change_erase_key: 258, //更改擦除密码
    _reader_cmd_1604_read_erase_key: 259, //读取擦除密码
    _reader_cmd_1604_read_erase_key_counter: 260, //读取擦除密码错误计数
    _reader_cmd_1604_PR_RD_clear: 261, //读写属性控制位清零
    _reader_cmd_1604_simulate_psnl: 262, //模拟个人化
    _reader_cmd_1604_psnl: 263, //个人化

    _reader_cmd_1608_reset: 270, //复位
    _reader_cmd_1608_read_user: 271, //读用户区
    _reader_cmd_1608_write_user: 272, //写用户区
    _reader_cmd_1608_read_config: 273, //读配置区
    _reader_cmd_1608_write_config: 274, //写配置区
    _reader_cmd_1608_verify_pwd: 275, //校验密码
    _reader_cmd_1608_change_pwd: 276, //更改密码
    _reader_cmd_1608_read_pwd: 277, //读密码
    _reader_cmd_1608_read_pwd_counter: 278, //读密码错误计数器
    _reader_cmd_1608_read_ar: 279, //读AR(用户区访问权限寄存器)
    _reader_cmd_1608_write_ar: 280, //写AR
    _reader_cmd_1608_read_fuse: 281, //读熔断标志
    _reader_cmd_1608_psnl: 282, //个人化

    _reader_cmd_153_reset: 290, //复位
    _reader_cmd_153_read_user: 291, //读用户区
    _reader_cmd_153_write_user: 292, //写用户区
    _reader_cmd_153_read_config: 293, //读配置区
    _reader_cmd_153_write_config: 294, //写配置区
    _reader_cmd_153_verify_pwd: 295, //校验密码
    _reader_cmd_153_change_pwd: 296, //更改密码
    _reader_cmd_153_read_pwd: 297, //读密码
    _reader_cmd_153_read_pwd_counter: 298, //读密码错误计数器
    _reader_cmd_153_read_ar: 299, //读AR(用户区访问权限寄存器)
    _reader_cmd_153_write_ar: 300, //写AR
    _reader_cmd_153_read_dcr: 301, //读DCR(设备配置寄存器)
    _reader_cmd_153_write_dcr: 302, //写DCR
    _reader_cmd_153_read_fuse: 303, //读熔断标志
    _reader_cmd_153_write_fuse: 304, //写熔断标志
    _reader_cmd_153_psnl: 305, //个人化

    _reader_cmd_mag_read: 500, //读磁条卡数据
    _reader_cmd_identity_read: 501, //读身份证信息
    _reader_cmd_ssc_read: 502, //读社保卡基本信息
    _reader_cmd_hc_read: 503, //读健康卡号
    _reader_cmd_bc_read: 504 //读银行卡/信用卡号

}

var CONNECT_MODE = {
    _connect_mode_usb: 0, //usb连接,只能连接一台
    _connect_mode_usb_number: 1, //usb编号连接，可以连接多台
    _connect_mode_serial_port: 2, //串口连接
    _connect_mode_net: 3, // 网络连接
    _connect_mode_bluetooth: 4 //蓝牙连接
}

/**
 * 获取reader对象, 方法内部会自动连接ReaderService服务
 */
function getReader() {
    var reader = {};
    var socketOpen = false;
    var target = null;

    //callback 回调函数
    reader.onResult = function(callback) {
        target.addEvent("SocketRet", callback);
    };

    var WSonOpen = function() {
        socketOpen = true;

        var resultData = {
            functionId: READER_CMD._reader_server_connect,
            result: 0,
            resultData: ""
        };
        if (target != null)
            target.fireEvent("SocketRet", resultData);

        //alert('WebSocket Open.');
        console.log('WebSocket Open.');
    };

    var WSonMessage = function(msg) {
        var str = msg.data.split('|');
        var len = str.length;
        if (str[0] != PROTOCEL_FLAG._reader_cmd_STX || str[len - 1] != PROTOCEL_FLAG._reader_cmd_ETX) {
            return;
        }
        //设置回调
        var resultData = {
            functionId: parseInt(str[1]), //命令代码
            result: parseInt(str[2]), //执行结果代码, 0 成功, 其它失败
            resultData: len == 5 ? str[3] : "" //返回结果
        };

        if (target != null)
            target.fireEvent("SocketRet", resultData);
    };

    var WSonClose = function() {
        socketOpen = false;
        /* var resultData = {
            functionId: READER_CMD._reader_server_close,
            result: 0,
            resultData: ""
        };

        if (target != null)
            target.fireEvent("SocketRet", resultData); */

        console.log('Reader Service Close.');
    };

    var WSonError = function() {
        /* var resultData = {
            functionId: READER_CMD._reader_server_connect,
            result: -1,
            resultData: ''
        };
        if (target != null)
            target.fireEvent("SocketRet", resultData); */
        console.error("Server not running");
    };

    //创建socket, 建立连接
    (function createSocket() {
        try {
            if ("WebSocket" in window) {
                socket = new WebSocket("ws://localhost:8256/ReaderWebServer/");
            } else if ("MozWebSocket" in window) {
                socket = new MozWebSocket("ws://localhost:8256/ReaderWebServer/");
            } else {
                return null;
            }
            socket.onopen = WSonOpen;
            socket.onmessage = WSonMessage;
            socket.onclose = WSonClose;
            socket.onerror = WSonError;
            target = new EventTarget();
        } catch (ex) {
            alert(ex.Message);
        }
    })();

    var SendCmd = function(readerCmd) {
        if (true == socketOpen) {
            var len = readerCmd.length;
            var entryCmd = PROTOCEL_FLAG._reader_cmd_STX + "|";
            for (var i = 0; i < len; i++) {
                entryCmd += readerCmd[i] + "|";
            }
            entryCmd += PROTOCEL_FLAG._reader_cmd_ETX;
            socket.send(entryCmd);
        } else {
            console.error("Server not connected.");
        }
    };

    /********************************************************************************************************
     ******************* 数据转换方法 ************************************************************************
     ********************************************************************************************************/
    /**
     * 将字符串转换成16进制字符
     * @param {string} str 要转换的字符串
     * @returns {string} 转换后的16进制字符
     */
    reader.strToHexCharCode = function(str) {
        if (str === "")
            return "";
        var hexCharCode = [];
        //hexCharCode.push("0x");
        for (var i = 0; i < str.length; i++) {
            hexCharCode.push((str.charCodeAt(i)).toString(16));
        }
        return hexCharCode.join("");
    };

    /**
     * 将16进制字符转换为字符串
     * @param {string} hexCharCodeStr 要转换的16进制字符
     * @returns {string} 转换后的字符串
     */
    reader.hexCharCodeToStr = function(hexCharCodeStr) {
        var trimedStr = hexCharCodeStr.trim();
        var rawStr =
            trimedStr.substr(0, 2).toLowerCase() === "0x" ?
            trimedStr.substr(2) :
            trimedStr;
        var len = rawStr.length;
        if (len % 2 !== 0) {
            alert("Illegal Format ASCII Code!");
            return "";
        }
        var curCharCode;
        var resultStr = [];
        for (var i = 0; i < len; i = i + 2) {
            curCharCode = parseInt(rawStr.substr(i, 2), 16); // ASCII Code Value
            resultStr.push(String.fromCharCode(curCharCode));
        }
        return resultStr.join("");
    };

    /*****************************************************************************************************************
     ************ 读写器操作方法 **************************************************************************************
     *****************************************************************************************************************/
    /**
     * 连接串口读写器
     * @param {number} port 端口号, 取值 0 ~ 19, 对应端口 COM1 ~ COM20
     * @param {number} baud 波特率, 取值 9600 ~ 115200
     * @returns {number} 读写器句柄
     */
    reader.connectSerialPort = function(port, baud) {
        SendCmd([READER_CMD._reader_cmd_connect, CONNECT_MODE._connect_mode_serial_port, port, baud]);
    };

    /**
     * 连接usb读写器
     * @returns 读写器句柄
     */
    reader.connectUsb = function() {
        SendCmd([READER_CMD._reader_cmd_connect, CONNECT_MODE._connect_mode_usb]);
    };

    /**
     * 按照usb编号连接读写器, 此方法可用于一台电脑连接多台设备的情况
     * @param {number} n 读写器编号, 取值 0 ~ 255
     * @returns {number} 读写器句柄
     */
    reader.connectUsbNumber = function(n) {
        SendCmd([READER_CMD._reader_cmd_connect, CONNECT_MODE._connect_mode_usb_number, n]);
    };

    /**
     * 断开读写器连接
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.disconnect = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_disconnect, icdev]);
    };

    /**
     * 读取硬件版本号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读写器硬件版本号
     */
    reader.readHardwareVersion = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_read_ver, icdev]);
    };

    /**
     * 让读写器鸣响一段时间
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} time 鸣响时间, 单位 10ms, 取值 0 ~ 255
     */
    reader.readerBeep = function(icdev, time) {
        SendCmd([READER_CMD._reader_cmd_beep, icdev, time]);
    };

    /**
     * 读产品序列号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读写器的产品序列号
     */
    reader.readProductSerialNumber = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_read_snr, icdev]);
    };

    /**
     * 更改读写器的串口波特率
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} baud 要更改的串口波特率, 取值 9600 ~ 115200
     * @description 读写器连接成功后再使用此方法更改其波特率
     */
    reader.SetBaudRate = function(icdev, baud) {
        SendCmd([READER_CMD._reader_cmd_set_baud, icdev, baud]);
    };

    /**
     * 获取大卡座是否有卡
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读写器大卡座插卡状态, 0 -- 无卡, 1 -- 有卡
     */
    reader.getReaderStatus = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_get_status, icdev]);
    };

    /**
     * 向读写器的 EEPROM 中写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 起始地址, 取值 0 ~ 999
     * @param {string} data 要写入的数据, 长度 <= 2000
     */
    reader.writeEEPROM = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_write_eeprom, icdev, offset, data]);
    };

    /**
     * 从读写器 EEPROM 中读取数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要读取的起始地址, 取值 0 ~ 999
     * @param {number} len 要读取的数据字节长度, 取值 1 ~ 1000
     * @returns {string} 返回读取到的数据, 长度为 len * 2.
     */
    reader.readEEPROM = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_read_eeprom, icdev, offset, len]);
    };

    /**
     * 设置Usb读写器编号
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} number 要设置的读写器编号, 取值 0 ~ 255
     * @description 使用连接读写器方法连接成功后, 再使用此方法设置读写器编号,
     * 编号设置成功后, 可使用 connectUsbNumber() 方法连接指定编号的设备
     */
    reader.setUsbReaderNumber = function(icdev, number) {
        SendCmd([READER_CMD._reader_cmd_set_number, icdev, number]);
    };

    /**
     * 获取Usb读写编号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 获取到的读写器编号
     */
    reader.getUsbReaderNumber = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_get_number, icdev]);
    };

    /**
     * 接触式卡座上电
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.turnOn = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_turn_on, icdev]);
    };

    /**
     * 接触式卡座下电
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.turnOff = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_turn_off, icdev]);
    };

    /**
     * 将 RF（射频 13.56MHz）先关闭一段时间后再重新打开, 此操作会让所有在天线区域的卡片都回到初始状态
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} time 复位场强射频信号时间 ( 1~ 500ms); 0 表示关闭射频场强信号
     */
    reader.rfReset = function(icdev, time) {
        SendCmd([READER_CMD._reader_cmd_rf_reset, icdev, time]);
    };

    /**
     * 选择非接触卡协议, 读写器默认 ISO14443 TypeA 协议, 如果操作其它协议卡片, 需要选择其相应的协议
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} prot 协议类型. 0: TypeA; 1: TypeB; 2: ICODE
     */
    reader.selectProtocol = function(icdev, prot) {
        SendCmd([READER_CMD._reader_cmd_select_protocol, icdev, prot]);
    };

    /****************************************************************************************************************
     *************** 非接卡(13.56MHZ)操作 ****************************************************************************
     ****************************************************************************************************************/
    /**
     * ISO14443 TypeA 协议卡片寻卡并激活, 在操作 TypeA协议卡片之前都要调用此方法
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 0 -- IDLE mode, 只有处在 IDLE 状态的卡片才响应读写器的命令,配合 rfHalt()方法可防止卡片反复操作. 
     * 1 -- ALL mode, 处在 IDLE 状态和 HALT 状态的卡片都将响应读写器的命令
     * @returns {string} 卡片序列号
     */
    reader.rfCard = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_rf_card, icdev, mode]);
    };

    /**
     * 终止对 TypeA 卡的操作, 终止后卡片不会响应任何命令. 如果再次操作卡片时需要重新寻卡
     * @param {number}} icdev 连接读写器返回的句柄
     */
    reader.rfHalt = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_rf_halt, icdev]);
    };

    /**
     * ISO14443 TypeB 协议卡片寻卡激活, 在操作 TypeB协议卡片之前都要调用此方法
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 卡片序列号
     */
    reader.rfCardB = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_rf_card_b, icdev]);
    };

    /**
     * 终止对 TypeB 卡的操作, 终止后卡片不会响应任何命令. 如果再次操作卡片时需要重新寻卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} snr 要终止操作的卡片的序列号
     */
    reader.rfHaltB = function(icdev, snr) {
        SendCmd([READER_CMD._reader_cmd_rf_halt_b, icdev, snr]);
    };

    /******************* S50/S70 卡操作方法 **********************/
    // 在操作 S50/S70 卡之前需要调用 rf_card 寻卡并激活卡片
    /**
     * 校验 S50/S70 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 要验证的密码类型, 0 -- 使用KeyA验证; 4 -- 使用KeyB验证
     * @param {number} sector 要验证的扇区号
     * @param {string} key 要验证的扇区密码, 长度为 12.
     */
    reader.mifareAuthenticationKey = function(icdev, mode, sector, key) {
        SendCmd([READER_CMD._reader_cmd_m_auth_key, icdev, mode, sector, key]);
    };

    /**
     * 向 s50/s70 指定块中写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要写入数据的块号(绝对块号)
     * @param {string} data 要写入的数据
     */
    reader.mifareWrite = function(icdev, block, data) {
        SendCmd([READER_CMD._reader_cmd_m_write, icdev, block, data]);
    };

    /**
     * 读取 s50/s70 指定块中的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要读取数据的块号(绝对块号)
     * @returns {string} 读取到的块数据
     */
    reader.mifareRead = function(icdev, block) {
        SendCmd([READER_CMD._reader_cmd_m_read, icdev, block]);
    };

    /**
     * 初始化 s50/s70 块值, 对某一块进行值操作时使用的是特殊的数据结构, 如果要进行加减值操作, 需要进行初始化操作, 然后才可以读、减、加的操作
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要初始化值的块号(绝对块号)
     * @param {number} value 要初始化的值
     */
    reader.mifareInitValue = function(icdev, block, value) {
        SendCmd([READER_CMD._reader_cmd_m_init_value, icdev, block, value]);
    };

    /**
     * 读取 s50/s70 指定块的值, 此块必须经过值初始化
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要读取值的块号(绝对块号)
     * @returns {number} 读取到的值
     */
    reader.mifareReadValue = function(icdev, block) {
        SendCmd([READER_CMD._reader_cmd_m_read_value, icdev, block]);
    };

    /**
     * 向 s50/s70 指定块加值, 此块必须经过值初始化
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要增加值的块号(绝对块号)
     * @param {number} value 要增加的值
     */
    reader.mifareIncrementValue = function(icdev, block, value) {
        SendCmd([READER_CMD._reader_cmd_m_increment_value, icdev, block, value]);
    };

    /**
     * s50/s70 指定块减值, 此块必须经过值初始化
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要减少值的块号(绝对块号)
     * @param {number} value 要减少的值
     */
    reader.mifareDecrementValue = function(icdev, block, value) {
        SendCmd([READER_CMD._reader_cmd_m_decrement_value, icdev, block, value]);
    };

    /****************** 非接 CPU 卡操作 *******************************************************/
    // 在非接 CPU 卡复位之前需要调用 rf_card 寻卡并激活卡片
    /**
     * 非接触 TypeA CPU 卡复位, 复位之前需要进行寻卡操作
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 卡片返回的复位信息
     */
    reader.mifareCpuReset = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_c_cpu_reset, icdev]);
    };

    /**
     * 非接触 TypeB CPU 卡复位, 复位之前需要进行寻卡操作
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.mifareCpuResetB = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_c_cpu_reset_b, icdev]);
    };

    /**
     * 非接 TypeA/B CPU 卡发送指令
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} cmd 要发送的 cos 指令
     * @returns {string} 卡片返回的应答信息, 包含sw1sw2
     */
    reader.mifareCpuTransmit = function(icdev, cmd) {
        SendCmd([READER_CMD._reader_cmd_c_cpu_Transmit, icdev, cmd]);
    };

    /******************** Ultralight / Ultralight C / Ultralight EV 卡操作 *******************/
    // 在操作 Ultralight / Ultralight C / Ultralight EV 卡之前需要调用 rf_card 寻卡并激活卡片
    /**
     * 校验 ultralight C 密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} key 密码, 长度 32.
     */
    reader.ulcAuthenticationKey = function(icdev, key) {
        SendCmd([READER_CMD._reader_cmd_uc_auth_key, icdev, key]);
    };

    /**
     * 校验 ultralight EV 密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} key 密码, 长度 8.
     */
    reader.ulevAuthenticationKey = function(icdev, key) {
        SendCmd([READER_CMD._reader_cmd_uev_auth_key, icdev, key]);
    };

    /**
     * 读 ultralight 及 ultralight C 数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要读取数据的块号, Ultralight 取值 0 ~ 15; Ultralight C 取值 0 ~ 43.
     * @returns {string} 读取到的数据
     */
    reader.ulcRead = function(icdev, block) {
        SendCmd([READER_CMD._reader_cmd_u_read, icdev, block]);
    };

    /**
     * 向 ultralight 及 ultralight C 写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} block 要写入数据的块号, Ultralight 取值 0 ~ 15; Ultralight C 取值 0 ~ 43.
     * @param {string} data 要写入的数据, 长度为 8, 不足补 0.
     */
    reader.ulcWrite = function(icdev, block, data) {
        SendCmd([READER_CMD._reader_cmd_u_write, icdev, block, data]);
    };

    /**
     * 更改 ultralight C 密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} key 要更改的新密码, 长度为 8.
     */
    reader.ulcChangeKey = function(icdev, key) {
        SendCmd([READER_CMD._reader_cmd_uc_change_key, icdev, key]);
    };

    /********************** NTAG213/215/216 标签操作**********************************************/
    // 在操作 NTAG213/215/216 标签之前需要调用 rf_card 寻卡并激活卡片
    /**
     * 校验 ntag213/214/216 密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd 要更改的新密码, 长度为 8.
     */
    reader.ntagAuthenticationPassword = function(icdev, pwd) {
        SendCmd([READER_CMD._reader_cmd_ntag_auth_pwd, icdev, pwd]);
    };

    /**
     * 读 ntag213/214/216 数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 要读取数据的页地址. NTAG213 取值范围 0 ~ 44; NTAG215 取值范围 0 ~ 134; NTAG216 取值范围 0 ~ 230.
     * @returns {string} 读取到的数据
     */
    reader.ntagRead = function(icdev, page) {
        SendCmd([READER_CMD._reader_cmd_ntag_read, icdev, page]);
    };

    /**
     * 向 ntag213/214/216 中写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 要写入数据的页地址. NTAG213 取值范围 0 ~ 44; NTAG215 取值范围 0 ~ 134; NTAG216 取值范围 0 ~ 230.
     * @param {string} data 要写入的数据, 长度为 8, 不足补 0.
     */
    reader.ntagWrite = function(icdev, page, data) {
        SendCmd([READER_CMD._reader_cmd_ntag_write, icdev, page, data]);
    };

    /**
     * 读ntag中nfc单向计数器的值
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} number 计数器编号
     * @returns {number} 读取到的计数器的值.
     */
    reader.ntagGetCounter = function(icdev, number) {
        SendCmd([READER_CMD._reader_cmd_ntag_counter, icdev, number]);
    };

    /**
     * 读ntag版本信息
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的版本信息
     */
    reader.ntagReadVersion = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_ntag_version, icdev]);
    };

    /**
     * 读取ntag签名信息
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的签名信息
     */
    reader.ntagReadSIG = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_ntag_sig, icdev]);
    };

    /************ ISO15693(ICODE2) 卡操作 ***********************************************************************/
    //注: 读写器默认协议类型为 ISO14443 TypeA, 在操作 ICODE2 之前请使用 selectProtocol() 选择协议类型
    /**
     * 设置数据交换模式
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 数据交换模式: 0 -- 标准模式, 波特率为 26.5 kbit; 1 -- 快模式, 波特率为 53 kbit/s
     */
    reader.icode2SetMode = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_icode2_set_mode, icdev, mode]);
    };

    /**
     * ICode2寻卡并执行防冲突操作,返回卡的 DSFID 和 UID
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} afi_flag 是否匹配 AFI 值. 0 -- 否; 1 -- 是.
     * @param {number} afi AFI 的值.
     * @param {number} slot_flag 通道类型. 0 -- 16 通道, 可以操作天线范围内的多张卡; 1 -- 1 通道, 只能操作一张卡
     * @returns {string} 卡片应答信息. 多张卡使用 # 号隔开, 每张卡数据使用 * 号隔开, * 号之前为 DSFID 的值(number, 10进制), * 号之后为卡 UID.
     * @example 12*abcdef1234567890#34*1234567890abcdef 表示有 2 张卡, 
     * 卡 1 的 UID 为 abcdef1234567890, DSFID 为 12; 卡 2 的 UID 为 1234567890abcdef, DSFID 为 34.
     */
    reader.icode2Inventory = function(icdev, afi_flag, afi, slot_flag) {
        SendCmd([READER_CMD._reader_cmd_icode2_inventory, icdev, afi_flag, afi, slot_flag]);
    };

    /**
     * 设置 ICODE2 卡为选择状态.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} uid 要设置为选择状态卡的 UID, 长度为 16.
     */
    reader.icode2Select = function(icdev, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_select, icdev, uid]);
    };

    /**
     * 使 ICODE2 卡进入 Ready 状态
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要设置为 Ready 状态的卡片 UID, 长度为 16.
     */
    reader.icode2Ready = function(icdev, select_flag, address_flag, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_reset_to_ready, icdev, select_flag, address_flag, uid]);
    };

    /**
     * 使 ICODE2 卡进入 Quiet 状态,卡片进入 Quiet 状态后不会响应任何命令
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} uid 要设置为 Quiet 状态的卡片 UID, 长度为 16.
     */
    reader.icode2Quiet = function(icdev, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_to_quiet, icdev, uid]);
    };

    /**
     * 读取 ICODE2 多个块数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {number} option_flag 0 -- 卡不返回块的安全状态; 1 -- 返回块的安全状态.
     * @param {number} startBlock 要读取数据的起始块号, 取值 0 ~ 27.
     * @param {number} blockNumber 读取的块数量
     * @param {string} uid 要读取数据的卡片 UID, 长度为 16.
     * @returns {string} 读取到的数据. 当 option_flag = 0 时, 每 8 位为一个块的数据, 当 option_flag = 1 时, 每 10 位为一个块的数据(包含安全状态), 
     * 其中前两位为安全状态, 如果为 '00' 表示此块未锁, 可以读写数据, 如果为 '01' 表示此块已锁, 只可读不可写.
     * @example 从 0 块开始读取 2 个块的数据, 即读取 0, 1 两个块的数据,
     * 如果不返回安全状态, 数据为 '1234567890ABCDEF', 其中 '12345678' 为 0 块数据, '90ABCDEF' 为 1 块数据.
     * 如果返回安全状态, 数据为 '00123456780190ABCDEF', 其中 '0012345678' 为 0 块安全状态和数据, 前两个字符 '00' 表示此块未锁, 后面数据为 0 块数据;
     * '0190ABCDEF' 为 1 块安全状态和数据, 前两个字符 '01' 表示此块已锁, 后面数据为 1 块数据.
     * 
     */
    reader.icode2Read = function(icdev, select_flag, address_flag, option_flag, startBlock, blockNumber, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_read, icdev, select_flag, address_flag, option_flag, startBlock, blockNumber, uid]);
    };

    /**
     * 向 ICODE2 多个块写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {number} startBlock 要写入数据的起始块号, 取值 0 ~ 27.
     * @param {number} blockNumber 写入的块数量
     * @param {string} uid 要写入数据的卡片 UID, 长度为 16.
     * @param {string} data 要写入的数据, 长度为 blockNumber * 8, 不足补 0.
     */
    reader.icode2Write = function(icdev, select_flag, address_flag, startBlock, blockNumber, uid, data) {
        SendCmd([READER_CMD._reader_cmd_icode2_write, icdev, select_flag, address_flag, startBlock, blockNumber, uid, data]);
    };

    /**
     * 写 AFI (应用标识)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要写 AFI 的卡片 UID, 长度为 16.
     * @param {string} afi AFI 的值
     */
    reader.icode2WriteAFI = function(icdev, select_flag, address_flag, uid, afi) {
        SendCmd([READER_CMD._reader_cmd_icode2_write_afi, icdev, select_flag, address_flag, uid, afi]);
    };

    /**
     * 写 DSFID (数据存储标识)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要写 DSFID 的卡片 UID, 长度为 16.
     * @param {string} dsfid DSFID 的值.
     */
    reader.icode2WriteDSFID = function(icdev, select_flag, address_flag, uid, dsfid) {
        SendCmd([READER_CMD._reader_cmd_icode2_write_dsfid, icdev, select_flag, address_flag, uid, dsfid]);
    };

    /**
     * 设置 EAS
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 请求标记. 0 -- 请求能被任何的卡执行; 1 -- 只被选择状态下的卡执行
     * @param {number} eas 0 -- 设置 EAS 位为 0; 1 -- 设置 EAS 位为 1.
     */
    reader.icode2SetEAS = function(icdev, mode, eas) {
        SendCmd([READER_CMD._reader_cmd_icode2_set_eas, icdev, mode, eas]);
    };

    /**
     * 永久锁定 ICODE2 数据块
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要锁定的卡片 UID, 长度为 16.
     * @param {numer} block 要锁定的块号, 取值 0 ~ 27.
     */
    reader.icode2Lock = function(icdev, select_flag, address_flag, uid, block) {
        SendCmd([READER_CMD._reader_cmd_icode2_lock, icdev, select_flag, address_flag, uid, block]);
    };

    /**
     * 锁定 ICODE2 卡的 AFI (应用标识)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要锁定 AFI 的卡片 UID, 长度为 16.
     */
    reader.icode2LockAFI = function(icdev, select_flag, address_flag, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_lock_afi, icdev, select_flag, address_flag, uid]);
    };

    /**
     * 锁定 ICODE2 卡的 DSFID (数据存储标识)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} select_flag 0 -- 根据 address_flag 的设置选择卡来执行该命令; 1 -- 只有选择状态下的卡能执行该命令
     * @param {number} address_flag 0 -- 请求不是地址模式, UID 无效, 任何卡都执行; 1 -- 请求是地址模式, UID 有较, 只有 UID 匹配的卡才执行该命令
     * @param {string} uid 要锁定 DSFID 的卡片 UID, 长度为 16.
     */
    reader.icode2LockDSFID = function(icdev, select_flag, address_flag, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_lock_dsfid, icdev, select_flag, address_flag, uid]);
    };

    /**
     * 锁定 ICODE2 卡 EAS
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 请求标记. 0 -- 请求能被任何的卡执行; 1 -- 只被选择状态下的卡执行
     */
    reader.icode2LockEAS = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_icode2_lock_eas, icdev, mode]);
    };
    /*
    //读取ICode2的多个块的安全状态信息
    reader.icode2GetSecurity = function(icdev, select_flag, address_flag, startBlock, blockNumber, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_get_mulblock_security, icdev, select_flag, address_flag, startBlock, blockNumber, uid]);
    };

    //获取ICode2系统信息
    reader.icode2GetSysInfo = function(icdev, select_flag, address_flag, uid) {
        SendCmd([READER_CMD._reader_cmd_icode2_get_sysinfo, icdev, select_flag, address_flag, uid]);
    };*/

    /***************************************************************************************************************************
     ************************** 超高频(900MHZ) 操作 *****************************************************************************
     ***************************************************************************************************************************/
    /**
     * 查找标签
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 返回标签的RSSI, CRC, PC, EPC, 分别用 # 号隔开
     * RSSI 反映的是芯片输入端信号大小,不包含天线增益和定向耦合器衰减等. RSSI 为芯片输入端信号强度, 十六进制有符号数, 单位为 dBm. 如 RSSI 为 0xC9, 代表芯片输入端信号强度为-55dBm.
     * CRC 为 标签的循环冗余校验, PC 为标签的协议控制, EPC 为标签的产品电子代码.
     * @example 返回数据为 'C9#D3#3400#1234567890ABCDEF12345678' 则 C9 为RSSI, D3为 CRC, 3400 为 PC, 1234567890ABCDEF12345678 为EPC.
     */
    reader.uhfInventory = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_uhf_inventory, icdev]);
    };

    /**
     * 设置选择模式
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 0x00 -- 在对标签的所有操作之前都预先发送 Select 指令选取特定的标签.
     * 0x01 -- 在对标签操作之前不发送 Select 指令.
     * 0x02 -- 仅对除轮询 Inventory 之外的标签操作之前发送 Select 指令, 如在 Read, Write, Lock, Kill 之前先通过 Select 选取特定的标签
     */
    reader.uhfSetSelectMode = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_uhf_select_mode, icdev, mode]);
    };

    /**
     * 选择标签并且同时设置 Select 模式为 0x02.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} epc 要选择的标签 EPC
     */
    reader.uhfSelect = function(icdev, epc) {
        SendCmd([READER_CMD._reader_cmd_uhf_select, icdev, epc]);
    };

    /**
     * 读取标签数据存储区 Memory Bank 中指定地址和长度的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd Access password, 长度 8.
     * @param {number} memBank 所要读取的区域. 0 -- RFU 区; 1 -- EPC 区; 2 -- TID 区; 3 -- User 区
     * @param {number} offset 读取的起始地址,以 word 为单位即 2 个 Byte/16 个 Bit
     * @param {number} len 要读取的长度, 以 word 为单位即 2 个 Byte/16 个 Bit
     * @returns {string} 返回读取到的数据, 所操作标签的 PC 及 EPC, 用 # 号隔开
     */
    reader.uhfRead = function(icdev, pwd, memBank, offset, len) {
        SendCmd([READER_CMD._reader_cmd_uhf_read, icdev, pwd, memBank, offset, len]);
    };

    /**
     * 向标签数据存储区 Memory Bank 中指定地址写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd Access password, 长度 8.
     * @param {number} memBank 所要写入的区域. 0 -- RFU 区; 1 -- EPC 区; 2 -- TID 区; 3 -- User 区
     * @param {number} offset 写入的起始地址,以 word 为单位即 2 个 Byte/16 个 Bit
     * @param {string} data 要写入的数据, 长度必须为 4 的倍数
     * @returns {string} 返回所操作标签的 PC 及 EPC, 用 # 号隔开
     */
    reader.uhfWrite = function(icdev, pwd, memBank, offset, data) {
        SendCmd([READER_CMD._reader_cmd_uhf_write, icdev, pwd, memBank, offset, data]);
    };

    /**
     * 锁定或解锁数据存储区
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd Access password, 长度 8.
     * @param {string} lockData 锁定数据参数, 长度 6. 
     */
    reader.uhfSetLock = function(icdev, pwd, lockData) {
        SendCmd([READER_CMD._reader_cmd_uhf_lock_unlock, icdev, pwd, lockData]);
    };

    /**
     * 灭活 Kill 标签, 灭活后卡片需要重新 Inventory 才可操作.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} killPwd Kill Password, 长度为 8. 标签如果没有设置过 Kill Password 密码, 即 Kill Password 密码全为 0, 按照 Gen2 协议, 标签不会被 Kill
     */
    reader.uhfKill = function(icdev, killPwd) {
        SendCmd([READER_CMD._reader_cmd_uhf_kill, icdev, killPwd]);
    };

    /**
     * 设置读写器工作地区
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} regionCode 要设置的工作区域代码. 1 -- 中国 900MHz; 4 -- 中国 800MHz; 2 -- 美国; 3 -- 欧洲; 6 -- 韩国.
     */
    reader.uhfSetRegion = function(icdev, regionCode) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_region, icdev, regionCode]);
    };

    /**
     * 设置工作信道
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} chIndex 信道代号 CH_Index, 计算公式如下:
     * 中国 900MHz 信道参数计算公式, Freq_CH 为信道频率： CH_Index = (Freq_CH-920.125M)/0.25M
     * 中国 800MHz 信道参数计算公式, Freq_CH 为信道频率： CH_Index = (Freq_CH-840.125M)/0.25M<
     * 美国信道参数计算公式, Freq_CH 为信道频率： CH_Index = (Freq_CH-902.25M)/0.5M
     * 欧洲信道参数计算公式, Freq_CH 为信道频率： CH_Index = (Freq_CH-865.1M)/0.2M
     * 韩国信道参数计算公式, Freq_CH 为信道频率： CH_Index = (Freq_CH-917.1M)/0.2M
     */
    reader.uhfSetChannel = function(icdev, chIndex) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_channel, icdev, chIndex]);
    };

    /**
     * 获取工作信道
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 返回工作信道代码 CH_Index, 计算公式如下:
     * 中国 900MHz 信道参数计算公式, Freq_CH 为信道频率： Freq_CH = CH_Index* 0.25M + 920.125M
     * 中国 800MHz 信道参数计算公式, Freq_CH 为信道频率： Freq_CH = CH_Index* 0.25M + 840.125M
     * 美国信道参数计算公式, Freq_CH 为信道频率： Freq_CH = CH_Index* 0.5M + 902.25M
     * 欧洲信道参数计算公式, Freq_CH 为信道频率： Freq_CH = CH_Index* 0.2M + 865.1M
     * 韩国信道参数计算公式, Freq_CH 为信道频率： Freq_CH = CH_Index* 0.2M + 917.1M
     */
    reader.uhfGetChannel = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_uhf_get_channel, icdev]);
    };

    /**
     * 设置自动跳频
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} hfss 0 -- 取消自动跳频; 1 -- 设置自动跳频
     */
    reader.uhfSetHFSS = function(icdev, hfss) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_hfss, icdev, hfss]);
    };

    /**
     * 设置发射功率
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} papower 读写器的发射功率, 如2000, 即 20dBm
     */
    reader.uhfSetPapower = function(icdev, papower) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_papower, icdev, papower]);
    };

    /**
     * 获取发射功率
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 获取到的发射功率, 如2000, 即 20dBm
     */
    reader.uhfGetPapower = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_uhf_get_papower, icdev]);
    };

    /**
     * 设置发射连续载波
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} cw 0 -- 关闭连续载波; 1 -- 打开连续载波
     */
    reader.uhfSetCW = function(icdev, cw) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_cw, icdev, cw]);
    };

    /**
     * 设置读写器接收解调器参数
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} modemParam 要设置的接收解调器参数, 分别为混频器 Mixer 增益(长度为 2), 中频放大器 IFAMP 增益 IF_G(长度为 2) 及信号解调阈值 Thrd(长度为 4)
     * 例如: '030601B0' 其中 03 为混频器 Mixer 增益 9dB; 06 为中频放大器 IFAMP 增益 36dB;
     * 01B0为信号解调阈值 Thrd. 信号解调阈值越小能解调的标签返回 RSSI 越低, 但越不稳定, 低于一定值完全不能解调;
     * 相反阈值越大能解调的标签返回信号 RSSI 越大, 距离越近, 越稳定. 0x01B0 是推荐的最小值
     */
    reader.uhfSetModem = function(icdev, modemParam) {
        SendCmd([READER_CMD._reader_cmd_uhf_set_modem, icdev, modemParam]);
    };

    /**
     * 获取读写器接收解调器参数
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 获取到的接收解调器参数, 分别为混频器 Mixer 增益(长度为 2), 中频放大器 IFAMP 增益 IF_G(长度为 2) 及信号解调阈值 Thrd(长度为 4)
     * 例如: '030601B0' 其中 03 为混频器 Mixer 增益 9dB; 06 为中频放大器 IFAMP 增益 36dB;
     * 01B0为信号解调阈值 Thrd. 信号解调阈值越小能解调的标签返回 RSSI 越低, 但越不稳定, 低于一定值完全不能解调;
     * 相反阈值越大能解调的标签返回信号 RSSI 越大, 距离越近, 越稳定. 0x01B0 是推荐的最小值
     */
    reader.uhfGetModem = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_uhf_get_modem, icdev]);
    };

    /*******************************************************************************************************
     ******************* 低频卡(125KHZ)操作 *************************************************************************
     *******************************************************************************************************/
    /**
     * 设置接收频率
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} rateCode 接收频率代码. 0 -- 1/8; 1 -- 1/16; 2 -- 1/32; 3 -- 1/40; 4 -- 1/50; 5 -- 1/64; 6 -- 1/100; 7 -- 1/128.
     */
    reader.lfSetDatarate = function(icdev, rateCode) {
        SendCmd([READER_CMD._reader_cmd_lf_set_datarate, icdev, rateCode]);
    };

    /**
     * 打开 125KHz 射频信号
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.lfOpenMod = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_lf_open_mod, icdev]);
    };

    /**
     * 关闭 125KHz 射频信号
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.lfCloseMod = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_lf_close_mod, icdev]);
    };

    /************* T5557 卡操作 ************************************************/
    /**
     * 向 T5557 射频卡中写入数据(不加密)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 写入数据所在的数据页地址. 取值范围应该为1（厂商代码区）或者为0（用户数据区）
     * @param {number} block 写入数据的数据块号. 当 page = 1 时取值 1 或 2, 当 page = 0 时, 取值 0 ~ 7.
     * @param {number} lockBit 是否在写入同时将该数据块数据锁定, 如果锁定该块数据将不能再进行修改.  0 -- 不锁定数据块, 1 -- 锁定数据块.
     * @param {string} data 要写入的数据, 长度为 8, 不足补 0.
     */
    reader.t5557WriteFree = function(icdev, page, block, lockBit, data) {
        SendCmd([READER_CMD._reader_cmd_t5557_write_free, icdev, page, block, lockBit, data]);
    };

    /**
     * 向 T5557 射频卡中写入数据(加密)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 写入数据所在的数据页地址. 取值范围应该为1（厂商代码区）或者为0（用户数据区）
     * @param {number} block 写入数据的数据块号. 当 page = 1 时取值 1 或 2, 当 page = 0 时, 取值 0 ~ 7.
     * @param {number} lockBit 是否在写入同时将该数据块数据锁定, 如果锁定该块数据将不能再进行修改.  0 -- 不锁定数据块, 1 -- 锁定数据块.
     * @param {string} pwd 要加密的密码, 长度为 8.
     * @param {string} data 要写入的数据, 长度为 8, 不足补 0.
     */
    reader.t5557WritePwd = function(icdev, page, block, lockBit, pwd, data) {
        SendCmd([READER_CMD._reader_cmd_t5557_write_pwd, icdev, page, block, lockBit, pwd, data]);
    };


    /**
     * 读取 T5557 卡中指定数据页指定数据区的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 读取数据所在的数据页地址. 取值范围应该为1（厂商代码区）或者为0（用户数据区）
     * @param {number} block 读取数据的数据块号. 当 page = 0 时取值 1 或 2, 当 page = 1 时, 取值 0 ~ 7.
     * @param {number} aorbit 是否在读取之前先用密码唤醒卡片. 0 -- 不唤醒卡片; 1 -- 唤醒卡片
     * @param {string} pwd 卡密码, 长度为 8.（如卡片密码无效, 则可提供 8 个长度的任意值）
     * @returns {string} 读取到的数据
     */
    reader.t5557ReadDirect = function(icdev, page, block, aorbit, pwd) {
        SendCmd([READER_CMD._reader_cmd_t5557_read_direct, icdev, page, block, aorbit, pwd]);
    };

    /**
     * 使用密码唤醒 AOR 模式进行读加密的 T5557 射频卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd 卡密码, 长度为 8.
     */
    reader.t5557Aor = function(icdev, pwd) {
        SendCmd([READER_CMD._reader_cmd_t5557_aor, icdev, pwd]);
    };

    /**
     * 将 T5557 卡转换成 ID 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} cardId 设置转换后的 ID 卡的卡号, 长度为 10.
     */
    reader.t5557toID = function(icdev, cardId) {
        SendCmd([READER_CMD._reader_cmd_t5557_to_id, icdev, cardId]);
    };

    /**
     * 将转换成的 ID 卡还原成 T5557 卡
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.idRestoreT5557 = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_id_restore_t5557, icdev]);
    };

    /*************** EM4001 / EM4305 卡操作******************************************************/
    /**
     * 读取EM4001或兼容 ID 卡的卡号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的卡号
     */
    reader.em4001Read = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_em_read, icdev]);
    };

    /**
     * 向 EM4305 卡指定地址写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} addr 要写入数据的地址, 取值 0 ~ 13.
     * @param {string} data 要写入的数据, 长度为 8, 不足补 0.
     */
    reader.em4305Write = function(icdev, addr, data) {
        SendCmd([READER_CMD._reader_cmd_em4305_write, icdev, addr, data]);
    };

    /**
     * 读取 EM4305 卡指定地址的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} addr 要读取数据的地址, 取值 0 ~ 13.
     * @returns {string} 返回读取到的数据
     */
    reader.em4305ReadBiphase = function(icdev, addr) {
        SendCmd([READER_CMD._reader_cmd_em4305_read_biphase, icdev, addr]);
    };

    /**
     * 读取 EM4305 卡指定地址的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} addr 要读取数据的地址, 取值 0 ~ 13.
     * @returns {string} 返回读取到的数据
     */
    reader.em4305ReadManchester = function(icdev, addr) {
        SendCmd([READER_CMD._reader_cmd_em4305_read_manchester, icdev, addr]);
    };

    /**
     * 验证 EM4305 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} pwd 卡片密码, 长度为 8.
     */
    reader.em4305Login = function(icdev, pwd) {
        SendCmd([READER_CMD._reader_cmd_em4305_login, icdev, pwd]);
    };

    /**
     * 锁定 EM4305 卡指定地址, 锁定后数据无法更改, 不可解锁.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} addr 锁定的起始地址.
     * @param {number} addrNumber 要锁定的地址数量.
     */
    reader.em4305Protect = function(icdev, addr, addrNumber) {
        SendCmd([READER_CMD._reader_cmd_em4305_protect, icdev, addr, addrNumber]);
    };

    /**
     * 休眠 EM4305 卡
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.em4305Disable = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_em4305_disable, icdev]);
    };

    /**
     * 设置 EM 卡类型
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 0 - Manchester RF/64; 1 - Manchester RF/32; 2 - Bi-phase RF/32
     */
    reader.em4305SetMode = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_em4305_set_mode, icdev, mode]);
    };

    /**
     * 把 EM4305 格式化成 ID 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} isLock 是否锁卡. 0为不加密, 1为加密, 把卡片加密,使得他人无法修改ID卡号
     * @param {string} lockPwd 锁卡密码, 长度 8.
     * @param {string} cardNo 格式化成 ID 卡的卡号, 长度 10.
     */
    reader.em4305ToId = function(icdev, isLock, lockPwd, cardNo) {
        SendCmd([READER_CMD._reader_cmd_em4305_to_id, icdev, isLock, lockPwd, cardNo]);
    };
    /*//把 EM4305 格式化成 FDX_B 卡
    reader.em4305ToFdxb = function(icdev, isLock, lockPwd, cardNo) {
        SendCmd([READER_CMD._reader_cmd_em4305_to_fdxb, icdev, isLock, lockPwd, cardNo]);
    };*/


    /*********************************************************************************************************
     ******************** 接触式卡 ****************************************************************************
     *********************************************************************************************************/

    /********** 接触 CPU 卡操作 ***************************************************/
    /**
     * 接触式 CPU 卡复位
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} slot 卡座编号, 0 -- CPU 大卡座; 1 -- SAM1; 2 -- SAM2; 3 -- SAM3; 4 -- SAM4
     * @returns {string} 卡片返回的复位信息
     */
    reader.cpuReset = function(icdev, slot) {
        SendCmd([READER_CMD._reader_cmd_cpu_reset, icdev, slot]);
    };

    /**
     * 接触式 CPU 卡发送指令
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} slot 卡座编号, 0 -- CPU 大卡座; 1 -- SAM1; 2 -- SAM2; 3 -- SAM3; 4 -- SAM4
     * @param {string} cmd 要发送的 cos 指令
     * @returns {string} 卡片返回的应答信息, 包含sw1sw2
     */
    reader.cpuTransmit = function(icdev, slot, cmd) {
        SendCmd([READER_CMD._reader_cmd_cpu_transmit, icdev, slot, cmd]);
    };

    /**
     * 设置接触 cpu 波特率
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} slot 卡座编号, 0 -- CPU 大卡座; 1 -- SAM1; 2 -- SAM2; 3 -- SAM3; 4 -- SAM4
     * @param {number} baud 要更改的新的波特率, 取值 9600/19200/38400
     */
    reader.cpuSetBaud = function(icdev, slot, baud) {
        SendCmd([READER_CMD._reader_cmd_cpu_set_baud, icdev, slot, baud]);
    };

    /************ AT24C 系列卡操作 ***************************************************************/
    /**
     * 写 AT24C 系列卡片
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} cardtype 卡类型编号. 1 -- AT24C01A; 2 -- AT24C02; 4 -- AT24C04; 8 -- AT24C08; 16 -- AT24C16;
     * 32 -- AT24C32; 64 -- AT24C64; 128 -- AT24C128; 256 -- AT24C256; 512 -- AT24C512; 1024 -- AT24C1024
     * @param {number} offset 写入数据的起始地址.
     * @param {string} data 要写入的数据.
     */
    reader.at24cWrite = function(icdev, cardtype, offset, data) {
        SendCmd([READER_CMD._reader_cmd_24c_write, icdev, cardtype, offset, data]);
    };

    /**
     * 读 AT24C 系列卡片
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} cardtype 卡类型编号. 1 -- AT24C01A; 2 -- AT24C02; 4 -- AT24C04; 8 -- AT24C08; 16 -- AT24C16;
     * 32 -- AT24C32; 64 -- AT24C64; 128 -- AT24C128; 256 -- AT24C256; 512 -- AT24C512; 1024 -- AT24C1024
     * @param {number} offset 读取数据的起始地址.
     * @param {number} len 读取数据的字节长度
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at24cRead = function(icdev, cardtype, offset, len) {
        SendCmd([READER_CMD._reader_cmd_24c_read, icdev, cardtype, offset, len]);
    };

    /************ AT45D041 卡操作 ***************************************************************/
    /**
     * 写 AT45D041 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 要写入的页地址, 范围: 0 ~ 2047
     * @param {number} offset 要写入的页内起始地址, 范围: 0 ~ 263
     * @param {string} data 要写入的数据.
     */
    reader.at45d041Write = function(icdev, page, offset, data) {
        SendCmd([READER_CMD._reader_cmd_45D041_write, icdev, page, offset, data]);
    };

    /**
     * 读 AT45D041 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} page 要读取的页地址, 范围: 0 ~ 2047
     * @param {number} offset 要读取的页内起始地址, 范围: 0 ~ 263
     * @param {number} len 要读取的数据的字节长度, 范围: 1 ~ 264
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at45d041Read = function(icdev, offset, page, len) {
        SendCmd([READER_CMD._reader_cmd_45D041_read, icdev, page, offset, len]);
    };

    /************ SLE4442 卡操作 ***************************************************************/
    /**
     * 读 SLE4442 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 读取数据的起始地址. 范围: 0 ~ 255.
     * @param {number} len 读取数据的字节长度, 范围: 1 ~ 256.
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.sle4442Read = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_4442_read, icdev, offset, len]);
    };

    /**
     * 写 SLE4442 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 写入数据的起始地址. 范围: 0 ~ 255.
     * @param {string} data 要写入的数据.
     */
    reader.sle4442Write = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_4442_write, icdev, offset, data]);
    };

    /**
     * 验证 SLE4442 卡密码, 密码校验成功后才能对卡片中的数据进行修改.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} sc 卡密码, 长度为 6.
     */
    reader.sle4442VerifySC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_4442_verify_sc, icdev, sc]);
    };

    /**
     * 更改 SLE4442 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} sc 新密码, 长度为 6.
     */
    reader.sle4442ChangeSC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_4442_change_sc, icdev, sc]);
    };

    /**
     * 读 SLE4442 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的卡密码. 密码校验成功后才能读取. 密码在没有校验成功之前此函数可能依然返回正确, 但实际未读取到卡片密码.
     */
    reader.sle4442ReadSC = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_4442_read_sc, icdev]);
    };

    /**
     * 读取 SLE4442 卡的密码错误计数器的值. 密码错误计数器的初始值为 3, 密码核对出错 1 次, 便减 1, 若计数器值为 0, 则卡自动锁死, 数据只可读出,
     * 不可再进行更改也无法再进行密码核对; 若不为零时, 其中核对正确 1 次, 可恢复到初始值 3.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的密码错误计数器的值
     */
    reader.sle4442ReadCounter = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_4442_read_counter, icdev]);
    };

    /**
     * 读取 SLE4442 卡的保护位
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的保护位数据, 长度为 8. SLE4442 卡字节地址 0 ～ 31 为保护区, 共 32 个字节, 每个字节用 1 bit 的保护位来标志是否被置保护.
     * 保护位为 4 byte 共 32 bit, 对应卡片前 32 字节. 如果此 bit 为 0 表示对应的字节已置保护, 为 1 表示未置保护. 
     */
    reader.sle4442ReadProBit = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_4442_read_pro_bit, icdev]);
    };

    /**
     * 保护 SLE4442 卡的保护区指定地址的数据, 保护后的数据被固化, 无法更改.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要保护的数据的起始地址. 范围: 0 ~ 23.
     * @param {data} data 要保护的数据, 必须和卡中已存在的数据一致.
     */
    reader.sle4442Protect = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_4442_protect, icdev, offset, data]);
    };

    /************ SLE4428 卡操作 ***************************************************************/

    /**
     * 读 SLE4428 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 读取数据的起始地址. 范围: 0 ~ 1023.
     * @param {number} len 读取的数据的字节长度. 范围: 1 ~ 1024.
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.sle4428Read = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_4428_read, offset, len]);
    };

    /**
     * 写 SLE4428 卡
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 写入数据的起始地址. 范围: 0 ~ 1023.
     * @param {string} data 要写入的数据
     */
    reader.sle4428Write = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_4428_write, offset, data]);
    };

    /**
     * 验证 SLE4428 卡密码, 密码校验成功后才能对卡片中的数据进行修改.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} sc 卡片密码, 长度 4.
     */
    reader.sle4428VerifySC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_4428_verify_sc, icdev, sc]);
    };

    /**
     * 更改 SLE4428 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} sc 新的卡片密码, 长度 4.
     */
    reader.sle4428ChangeSC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_4428_change_sc, icdev, sc]);
    };

    /**
     * 读取 SLE4428 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的卡片密码, 长度 4.
     */
    reader.sle4428ReadSC = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_4428_read_sc, icdev]);
    };

    /**
     * 读取 SLE4428 卡密码错误计数器. 密码错误计数器的初始值为8, 密码核对出错 1 次, 便减 1, 若计数器值为 0, 则卡自动锁死, 
     * 数据只可读出, 不可再进行更改也无法再进行密码核对; 若不为零时, 其中核对正确 1 次, 可恢复到初始值 8.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的卡片密码错误计数器的值
     */
    reader.sle4428ReadCounter = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_4428_read_counter, icdev]);
    };

    /**
     * 从 SLE4428 卡指定地址带保护位读数据.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 读取数据的起始地址. 范围: 0 ~ 1023.
     * @param {number} len 读取的数据的字节长度. 范围: 1 ~ 1024.
     * @returns {string} 读取到的数据, 长度为 len * 4. 每两位数据为 1 个字节, 每个字节的数据后面跟一个保护位标志字节, 该字节值为 0x00 表示相应的字节已保护, 0xff 表示未被保护.
     * @example 从 0 字节开始读取 2 个字节的数据, 返回的数据为 '010002FF', 其中 01 为 0 字节的数据, 已保护, 02 为 1 字节数据, 未保护.
     */
    reader.sle4428ReadWithPro = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_4428_read_pro, icdev, offset, len]);
    };

    /**
     * 向 SLE4428 卡指定地址写数据并保护,保护后的数据被固化,无法更改.
     * @param {number} icdev 
     * @param {number} offset 写入数据的起始地址. 范围: 0 ~ 1023.
     * @param {string} data 要写入并保护的数据.
     */
    reader.sle4428WritePro = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_4428_write_pro, icdev, offset, data]);
    };

    /**
     * 保护 SLE4428 卡的指定地址的数据, 保护后的数据被固化, 无法更改.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要保护的数据的起始地址. 范围: 0 ~ 1023.
     * @param {data} data 要保护的数据, 必须和卡中已存在的数据一致.
     */
    reader.sle4428Portect = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_4428_protect, icdev, offset, data]);
    };

    /********** AT88SC102 卡操作 ****************************************************************/
    /**
     * 读取 AT88SC102 卡中的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取的区地址. 0 -- 配置区; 1 -- 应用区一; 2 -- 应用区二
     * @param {number} offset 要读取的区内偏移地址.
     * 当 zone = 0 时取值范围为 0 ~ 21; 其中包含厂商代码, 发行商代码, 用户密码, 密码错误计数器及代码保护区数据.
     * 当 zone = 1 时取值范围为 0 ~ 69; 其中包含应用区一读写属性, 应用区一数据及应用区一擦除密码.
     * 当 zone = 2 时取值范围为 0 ~ 85; 其中包含应用区二读写属性, 应用区二数据, 应用区二擦除密码, 应用区二擦除密码错误计数器及测试区.
     * @param {number} len 读取数据的字节长度.
     * 当 zone = 0 时取值范围为 1 ~ 22; 当 zone = 1 时取值范围为 1 ~ 70; 当 zone = 2 时取值范围为 1 ~ 86;
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at88sc102Read = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_102_read, icdev, zone, offset, len]);
    };

    /**
     * 向 AT88SC102 卡中写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要写入的区地址. 0 -- 配置区; 1 -- 应用区一; 2 -- 应用区二
     * @param {number} offset 要写入的区内偏移地址.
     * 当 zone = 0 时取值范围为 0 ~ 21; 其中包含厂商代码, 发行商代码, 用户密码, 密码错误计数器及代码保护区数据.
     * 当 zone = 1 时取值范围为 0 ~ 69; 其中包含应用区一读写属性, 应用区一数据及应用区一擦除密码.
     * 当 zone = 2 时取值范围为 0 ~ 85; 其中包含应用区二读写属性, 应用区二数据, 应用区二擦除密码, 应用区二擦除密码错误计数器及测试区.
     * @param {string} data 要写入的数据
     */
    reader.at88sc102Write = function(icdev, zone, offset, data) {
        SendCmd([READER_CMD._reader_cmd_102_write, icdev, zone, offset, data]);
    };

    /**
     * 擦除 AT88SC102 卡指定地址的数据. 写数据之前必须先擦除数据.
     * AT88SC102 卡擦除操作具有从偶地址开始双字节擦除特性, 即擦除一个字节时, 与之相邻的某个字节一起被擦除, 被擦两个字节的第一个字节地址必为偶数.
     * 比如擦除地址为 35 的字节内容时, 34、35 两字节内容一起被擦除.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要擦除的区地址. 0 -- 配置区; 1 -- 应用区一; 2 -- 应用区二
     * @param {number} offset 要擦除的区内偏移地址.
     * 当 zone = 0 时取值范围为 0 ~ 21; 其中包含厂商代码, 发行商代码, 用户密码, 密码错误计数器及代码保护区数据.
     * 当 zone = 1 时取值范围为 0 ~ 69; 其中包含应用区一读写属性, 应用区一数据及应用区一擦除密码.
     * 当 zone = 2 时取值范围为 0 ~ 85; 其中包含应用区二读写属性, 应用区二数据, 应用区二擦除密码, 应用区二擦除密码错误计数器及测试区.
     * @param {number} len 擦除的字节长度.
     * 当 zone = 0 时取值范围为 1 ~ 22; 当 zone = 1 时取值范围为 1 ~ 70; 当 zone = 2 时取值范围为 1 ~ 86;
     */
    reader.at88sc102Erase = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_102_erase, icdev, zone, offset, len]);
    };

    /**
     * 校验 AT88SC102 卡的用户密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sc 要校验的密码. 长度为 4.
     */
    reader.at88sc102VerifySC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_102_verify_sc, icdev, sc]);
    };

    /**
     * 更改 AT88SC102 卡的用户密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sc 新的用户密码. 长度为 4.
     */
    reader.at88sc102VerifySC = function(icdev, sc) {
        SendCmd([READER_CMD._reader_cmd_102_change_sc, icdev, sc]);
    };

    /**
     * 读取 AT88SC102 卡的用户密码
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的用户密码. 长度为 4.
     */
    reader.at88sc102ReadSC = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_102_read_sc, icdev]);
    };

    /**
     * 读取 AT88SC102 卡密码错误计数器的值. 初始值为4.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的用户密码错误计数器的值.
     */
    reader.at88sc102ReadCounter = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_102_read_sc_counter, icdev]);
    };

    /**
     * 校验 AT88SC102 卡应用区擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 应用区地址, 其值为 1 或 2.
     * @param {string} ek 擦除密码, 当 zone = 1 时, ek 的长度为 12, 当 zone = 2 时, ek 的长度为 8
     */
    reader.at88sc102VerifyEraseKey = function(icdev, zone, ek) {
        SendCmd([READER_CMD._reader_cmd_102_verify_erase_key, icdev, zone, ek]);
    };

    /**
     * 更改 AT88SC102 卡应用区擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 应用区地址, 其值为 1 或 2.
     * @param {string} ek 新的擦除密码, 当 zone = 1 时, ek 的长度为 12, 当 zone = 2 时, ek 的长度为 8
     */
    reader.at88sc102ChangeEraseKey = function(icdev, zone, ek) {
        SendCmd([READER_CMD._reader_cmd_102_change_erase_key, icdev, zone, ek]);
    };

    /**
     * 读取 AT88SC102 卡应用区擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 应用区地址, 其值为 1 或 2.
     * @returns {string} 读取到的的擦除密码, 当 zone = 1 时, ek 的长度为 12, 当 zone = 2 时, ek 的长度为 8
     */
    reader.at88sc102ReadEraseKey = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_102_read_erase_key, icdev, zone]);
    };

    /**
     * 读取 AT88SC102 卡应用 2 区擦除计数器的值. 熔断前不起作用; 熔断后应用区二擦除数限制在 128 次, 每擦除1次, 则计数器减1, 共可擦128次
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的擦除计数器的值.
     */
    reader.at88sc102ReadEraseCounter = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_102_read_erase_counter, icdev]);
    };

    /**
     * AT88SC102 卡读写属性控制位清零. 
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要清零的应用区地址, 其值为 1 或 2.
     * @param {number} wr 要清零的读写属性, 1 -- 写属性PR; 2 -- 读属性RD.
     * @description 写属性控制位 PR 的作用在于控制应用区的写数据操作. 熔断前, 不论 PR 取值, 用户密码核对正确后, 可向受控应用区中写入数据.
     * 熔断后, 当 PR 设置为 1 时 用户密码核对正确后, 可写入数据; 当 PR 设置为 0 时, 任何情况下不可写.
     * 读属性控制位 RD 的作用在于控制应用区的读数据操作. 熔断前后属性一致
     * 当 RD 设置为 1 时, 任何情况下可读出受控应用区的数据; 当 RD 置为 0 时, 用户密码核对正确后, 方可读出数据
     */
    reader.at88sc102PrRdClear = function(icdev, zone, wr) {
        SendCmd([READER_CMD._reader_cmd_102_PR_RD_clear, icdev, zone, wr]);
    };

    /**
     * AT88SC102 卡模拟个人化操作
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 0 -- 模拟个人化操作; 1 -- 取消模拟.
     */
    reader.at88sc102SimulatePsnl = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_102_simulate_psnl, icdev, mode]);
    };

    /**
     * AT88SC102 卡个人化(熔断)操作, 不可逆
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.at88sc102Psnl = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_102_psnl, icdev]);
    };

    /************ AT88SC1604 卡操作 **************************************************************/
    /**
     * 读 AT88SC1604 卡中的数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取的区地址; 0 -- 公共区;  1 ~ 4 为应用区
     * @param {number} offset 要读取数据的起始地址
     * 当 zone = 0 时取值范围: 0 ~ 26; 其中包含厂商代码, 发行商代码, 总密码, 总密码错误计数器, 代码保护区, 应用一区密码, 一区密码错误计数器, 一区擦除密码及一区擦除密码错误计数器
     * 当 zone = 1 时取值范围: 0 ~ 1199; 其中包含应用一区数据(前 1195 byte), 二区密码, 二区擦除密码及二区擦除密码错误计数器.
     * 当 zone = 2 时取值范围: 0 ~ 260; 其中包含应用二区数据(前 256 byte), 三区密码, 三区擦除密码及三区擦除密码错误计数器.
     * 当 zone = 3 时取值范围: 0 ~ 260; 其中包含应用三区数据(前 256 byte), 四区密码, 四区擦除密码及四区擦除密码错误计数器.
     * 当 zone = 4 时取值范围: 0 ~ 257; 其中包含应用四区数据(前 256 byte)及测试区.
     * @param {number} len 要读取的字节长度. 
     * 当 zone = 0 时取值范围: 1 ~ 27; 当 zone = 1 时取值范围: 1 ~ 1200; 当 zone = 2 时取值范围: 1 ~ 261; 当 zone = 3 时取值范围: 1 ~ 261; 当 zone = 4 时取值范围: 1 ~ 258;
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at88sc1604Read = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_1604_read, icdev, zone, offset, len]);
    };

    /**
     * 向 AT88SC1604 卡中指定地址写入数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要写入的区地址; 0 -- 公共区;  1 ~ 4 为应用区
     * @param {number} offset 要写入数据的起始地址
     * 当 zone = 0 时取值范围: 0 ~ 26; 其中包含厂商代码, 发行商代码, 总密码, 总密码错误计数器, 代码保护区, 应用一区密码, 一区密码错误计数器, 一区擦除密码及一区擦除密码错误计数器
     * 当 zone = 1 时取值范围: 0 ~ 1199; 其中包含应用一区数据(前 1195 byte), 二区密码, 二区擦除密码及二区擦除密码错误计数器.
     * 当 zone = 2 时取值范围: 0 ~ 260; 其中包含应用二区数据(前 256 byte), 三区密码, 三区擦除密码及三区擦除密码错误计数器.
     * 当 zone = 3 时取值范围: 0 ~ 260; 其中包含应用三区数据(前 256 byte), 四区密码, 四区擦除密码及四区擦除密码错误计数器.
     * 当 zone = 4 时取值范围: 0 ~ 257; 其中包含应用四区数据(前 256 byte)及测试区.
     * @param {string} data 要写入的数据
     */
    reader.at88sc1604Write = function(icdev, zone, offset, data) {
        SendCmd([READER_CMD._reader_cmd_1604_write, icdev, zone, offset, data]);
    };

    /**
     * 擦除 AT88SC1604 卡中的数据, 写数据之前必须先擦除数据.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要擦除数据的区地址; 0 -- 公共区;  1 ~ 4 为应用区
     * @param {number} offset 要擦除数据的起始地址
     * 当 zone = 0 时取值范围: 0 ~ 26; 其中包含厂商代码, 发行商代码, 总密码, 总密码错误计数器, 代码保护区, 应用一区密码, 一区密码错误计数器, 一区擦除密码及一区擦除密码错误计数器
     * 当 zone = 1 时取值范围: 0 ~ 1199; 其中包含应用一区数据(前 1195 byte), 二区密码, 二区擦除密码及二区擦除密码错误计数器.
     * 当 zone = 2 时取值范围: 0 ~ 260; 其中包含应用二区数据(前 256 byte), 三区密码, 三区擦除密码及三区擦除密码错误计数器.
     * 当 zone = 3 时取值范围: 0 ~ 260; 其中包含应用三区数据(前 256 byte), 四区密码, 四区擦除密码及四区擦除密码错误计数器.
     * 当 zone = 4 时取值范围: 0 ~ 257; 其中包含应用四区数据(前 256 byte)及测试区.
     * @param {number} len 要擦除的字节长度.
     * 当 zone = 0 时取值范围: 1 ~ 27; 当 zone = 1 时取值范围: 1 ~ 1200; 当 zone = 2 时取值范围: 1 ~ 261; 当 zone = 3 时取值范围: 1 ~ 261; 当 zone = 4 时取值范围: 1 ~ 258;
     */
    reader.at88sc1604Erase = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_1604_erase, icdev, zone, offset, len]);
    };

    /**
     * 校验 AT88SC1604 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要校验的密码区域, 0 -- 主密码;  1 ~ 4 为应用区密码.
     * @param {string} sc 密码, 长度为 4.
     */
    reader.at88sc1604VerifySC = function(icdev, zone, sc) {
        SendCmd([READER_CMD._reader_cmd_1604_verify_sc, icdev, zone, sc]);
    };

    /**
     * 更改 AT88SC1604 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要更改的密码区域, 0 -- 主密码;  1 ~ 4 为应用区密码.
     * @param {string} sc 新密码, 长度为 4.
     */
    reader.at88sc1604ChangeSC = function(icdev, zone, sc) {
        SendCmd([READER_CMD._reader_cmd_1604_change_sc, icdev, zone, sc]);
    };

    /**
     * 读取 AT88SC1604 卡密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取的密码区域, 0 -- 主密码;  1 ~ 4 为应用区密码.
     * @returns {string} 读取到的密码, 长度为 4.
     */
    reader.at88sc1604ReadSC = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_1604_Read_sc, icdev, zone]);
    };

    /**
     * 读取 AT88SC1604 卡的密码错误计数器
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取错误计数的密码区域, 0 -- 主密码;  1 ~ 4 为应用区密码.
     * @returns {number} 读取到的密码错误计数器的值
     */
    reader.at88sc1604ReadCounter = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_1604_read_sc_counter, icdev, zone]);
    };

    /**
     * 核对 AT88SC1604 卡擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要验证密码的应用区地址, 取值 1 ~ 4.
     * @param {string} ek 要验证的擦除密码, 长度为 4.
     */
    reader.at88sc1604VerifyEraseKey = function(icdev, zone, ek) {
        SendCmd([READER_CMD._reader_cmd_1604_verify_erase_key, icdev, zone, ek]);
    };

    /**
     * 更改 AT88SC1604 卡擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要更改密码的应用区地址, 取值 1 ~ 4.
     * @param {string} ek 新的擦除密码, 长度为 4.
     */
    reader.at88sc1604ChangeEraseKey = function(icdev, zone, ek) {
        SendCmd([READER_CMD._reader_cmd_1604_change_erase_key, icdev, zone, ek]);
    };

    /**
     * 读取 AT88SC1604 卡擦除密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取密码的应用区地址, 取值 1 ~ 4.
     * @returns {string} 读取到的擦除密码, 长度为 4.
     */
    reader.at88sc1604ReadEraseKey = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_1604_read_erase_key, icdev, zone]);
    };

    /**
     * 读出 AT88SC1604 卡擦除密码错误计数器值
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取密码错误计数的应用区地址, 取值 1 ~ 4.
     * @returns {number} 读取到的擦除密码错误计数
     */
    reader.at88sc1604ReadEraseKeyCounter = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_1604_read_erase_key_counter, icdev, zone]);
    };

    /**
     * AT88SC1604 卡读写属性控制位清零.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要清零的应用区地址, 取值 1 ~ 4.
     * @param {number} wr 要清零的读写属性, 1 -- 写属性PR; 2 -- 读属性RD.
     */
    reader.at88sc1604PrRdClear = function(icdev, zone, wr) {
        SendCmd([READER_CMD._reader_cmd_1604_PR_RD_clear, icdev, zone, wr]);
    };

    /**
     * AT88SC1604 卡模拟个人化操作
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} mode 0 -- 模拟个人化操作; 1 -- 取消模拟
     */
    reader.at88sc1604SimulatePsnl = function(icdev, mode) {
        SendCmd([READER_CMD._reader_cmd_1604_simulate_psnl, icdev, mode]);
    };

    /**
     * AT88SC1604 卡个人化(熔断)操作,不可逆
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.at88sc1604Psnl = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_1604_psnl, icdev]);
    };

    /******** AT88SC1608 卡操作 ********************************************************/

    /**
     * AT88SC1608 卡复位
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 卡片返回的复位信息, 长度为 8.
     */
    reader.at88sc1608Reset = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_1608_reset, icdev]);
    };

    /**
     * 读取 AT88SC1608 卡用户区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 读取的用户区, 取值 0 ~ 7.
     * @param {number} offset 读取的起始地址.范围 0 ~ 255.
     * @param {number} len 要读取的字节长度. 范围 1 ~ 256.
     * @returns {string} 返回读取到的数据, 长度为 len * 2.
     */
    reader.at88sc1608ReadUser = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_1608_read_user, icdev, zone, offset, len]);
    };

    /**
     * 向 AT88SC1608 卡用户区写数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 写入的用户区, 取值 0 ~ 7.
     * @param {number} offset 写入的起始地址.范围 0 ~ 255.
     * @param {number} data 写入的数据
     */
    reader.at88sc1608WriteUser = function(icdev, zone, offset, data) {
        SendCmd([READER_CMD._reader_cmd_1608_write_user, icdev, zone, offset, data]);
    };

    /**
     * 读 AT88SC1608 卡配置区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要读取的起始地址. 范围 0 ~ 127.
     * @param {number} len 要读取的字节长度. 范围 1 ~ 128.
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at88sc1608ReadConfig = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_1608_read_config, icdev, offset, len]);
    };

    /**
     * 写 AT88SC1608 卡配置区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要写入的起始地址. 范围 0 ~ 127.
     * @param {string} data 要写入的数据
     */
    reader.at88sc1608WriteConfig = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_1608_write_config, icdev, offset, data]);
    };

    /**
     * 校验 AT88SC1608 卡密码. 哪个区用哪套密码或是否要认证要由访问权限 AR0 ~ AR7 来决定.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 验证的密码组编号, 取值 0 ~ 7
     * @param {number} wr 验证的密码类型, 0 -- 写密码; 1 -- 读密码.
     * @param {string} pwd 要验证的密码, 长度为 6.
     */
    reader.at88sc1608VerifyPwd = function(icdev, sets, wr, pwd) {
        SendCmd([READER_CMD._reader_cmd_1608_verify_pwd, icdev, sets, wr, pwd]);
    };

    /**
     * 修改 AT88SC1608 卡用户区密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 修改的密码组编号, 取值 0 ~ 7
     * @param {number} wr 修改的密码类型, 0 -- 写密码; 1 -- 读密码.
     * @param {string} pwd 新的密码, 长度为 6.
     */
    reader.at88sc1608ChangePwd = function(icdev, sets, wr, pwd) {
        SendCmd([READER_CMD._reader_cmd_1608_change_pwd, icdev, sets, wr, pwd]);
    };

    /**
     * 读 AT88SC1608 卡密码.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要读取的密码组编号, 取值 0 ~ 7
     * @param {number} wr 要读取的密码类型, 0 -- 写密码; 1 -- 读密码.
     * @returns {string} 读取到的密码, 长度为 6.
     */
    reader.at88sc1608ReadPwd = function(icdev, sets, wr) {
        SendCmd([READER_CMD._reader_cmd_1608_read_pwd, icdev, sets, wr]);
    };

    /**
     * 读 AT88SC1608 卡密码错误计数.
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要读取错误计数的密码组编号, 取值 0 ~ 7
     * @param {number} wr 要读取错误计数的密码类型, 0 -- 写密码; 1 -- 读密码.
     * @returns {number} 读取到的错误计数的值
     */
    reader.at88sc1608ReadPwdCounter = function(icdev, sets, wr) {
        SendCmd([READER_CMD._reader_cmd_1608_read_pwd_counter, icdev, sets, wr]);
    };

    /**
     * 读 AT88SC1608 卡的 AR 值.(用户区访问权限寄存器)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取 AR 的用户区, 取值 0 ~ 7.
     * @returns {number} 读取到的 AR 的值
     */
    reader.at88sc1608ReadAR = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_1608_read_ar, icdev, zone]);
    };

    /**
     * 更改 AT88SC1608 卡的 AR（用户区访问权限寄存器）
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要更改 AR 的用户区, 取值 0 ~ 7.
     * @param {number} ar 新的 AR 值
     */
    reader.at88sc1608WriteAR = function(icdev, zone, ar) {
        SendCmd([READER_CMD._reader_cmd_1608_write_ar, icdev, zone, ar]);
    };

    /**
     * 读取 AT88SC1608 卡熔断标志. 熔断标志 fuse 占一个字节, 低三位分别为 FAB, CMA, PER. 如果全为 1 表示所有的存储空间可读写,  如果为 0 表示已熔断, 不可逆.
     * FAB 为 ATMEL 的芯片出厂时的熔断标志; CMA 为卡厂的卡片出厂时的熔断标志; PER 为应用系统启动前个人化时的熔断标志。
     * 在将芯片运送到卡制造商之前, ATMEL 做 FAB 熔断操作, 使 FAB = 0.
     * 在将卡运送到发卡机构之前, 卡厂写入自己的卡商代码, 做 CMA 熔断操作, 使 CMA = 0.
     * 将卡运送给最终用户之前，发行机构会做 PER 熔断操作，使 PER = 0.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的熔断标志的值
     */
    reader.at88sc1608ReadFuse = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_1608_read_fuse, icdev]);
    };

    /**
     * AT88SC1608 卡个人化操作（熔断操作, 使 PER = 0).
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.at88sc1608Psnl = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_1608_psnl, icdev]);
    };

    /************** AT88SC153 卡操作 **********************************************************/
    /**
     * 对AT88SC153卡复位,操作卡前需要进行复位操作.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 卡片返回的复位信息, 长度为 8.
     */
    reader.at88sc153Reset = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_153_reset, icdev]);
    };

    /**
     * 读 AT88SC153 卡用户区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取数据的用户区,范围 0 ~ 2
     * @param {number} offset 读取的起始地址, 范围 0 ~ 63.
     * @param {number} len 要读取的字节长度, 范围 1 ~ 64.
     * @returns {string} 读取到的数据, 长度 len * 2.
     */
    reader.at88sc153ReadUser = function(icdev, zone, offset, len) {
        SendCmd([READER_CMD._reader_cmd_153_read_user, icdev, zone, offset, len]);
    };

    /**
     * 写 AT88SC153 卡用户区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要写入数据的用户区,范围 0 ~ 2
     * @param {number} offset 写入数据的起始地址, 范围 0 ~ 63.
     * @param {string} data 要写入的数据
     */
    reader.at88sc153WriteUser = function(icdev, zone, offset, data) {
        SendCmd([READER_CMD._reader_cmd_153_write_user, icdev, zone, offset, data]);
    };

    /**
     * 读 AT88SC153 卡配置区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 要读取的起始地址, 范围 0 ~ 63.
     * @param {number} len 要读取的字节长度. 范围 1 ~ 64.
     * @returns {string} 读取到的数据, 长度为 len * 2.
     */
    reader.at88sc153ReadConfig = function(icdev, offset, len) {
        SendCmd([READER_CMD._reader_cmd_153_read_config, icdev, offset, len]);
    };

    /**
     * 写 AT88SC153 卡配置区数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} offset 写入的起始地址, 范围 0 ~ 63.
     * @param {string} data 要写入的数据
     */
    reader.at88sc153WriteConfig = function(icdev, offset, data) {
        SendCmd([READER_CMD._reader_cmd_153_write_config, icdev, offset, data]);
    };

    /**
     * 校验 AT88SC153 卡的读写密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要校验的密码组编号: 0 ~ 1
     * @param {number} wr 要校验的密码类型,  0 -- write key; 1 -- read key.
     * @param {string} pwd 密码, 长度为 6.
     */
    reader.at88sc153VerifyPwd = function(icdev, sets, wr, pwd) {
        SendCmd([READER_CMD._reader_cmd_153_verify_pwd, icdev, sets, wr, pwd]);
    };

    /**
     * 更改 AT88SC153 卡的读写密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要更改的密码组编号: 0 ~ 1
     * @param {number} wr 要更改的密码类型,  0 -- write key; 1 -- read key.
     * @param {string} pwd 新密码, 长度为 6.
     */
    reader.at88sc153ChangePwd = function(icdev, sets, wr, pwd) {
        SendCmd([READER_CMD._reader_cmd_153_change_pwd, icdev, sets, wr, pwd]);
    };

    /**
     * 读 AT88SC153 卡的读写密码
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要读取的密码组编号: 0 ~ 1
     * @param {number} wr 要读取的密码类型,  0 -- write key; 1 -- read key.
     * @returns {string} 读取到的密码
     */
    reader.at88sc153ReadPwd = function(icdev, sets, wr) {
        SendCmd([READER_CMD._reader_cmd_153_read_pwd, icdev, sets, wr]);
    };

    /**
     * 读 AT88SC153 卡的读写密码错误计数器
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} sets 要读取错误计数的密码组编号: 0 ~ 1
     * @param {number} wr 要读取错误计数的密码类型,  0 -- write key; 1 -- read key.
     * @returns {number} 读取到的密码错误计数器的值.
     */
    reader.at88sc153ReadPwdCounter = function(icdev, sets, wr) {
        SendCmd([READER_CMD._reader_cmd_153_read_pwd_counter, icdev, sets, wr]);
    };

    /**
     * 读 AT88SC153 卡的 AR (用户区访问权限寄存器)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要读取 AR 的用户区: 0 ~ 2.
     * @returns {number} 读取到的 AR 的值.
     */
    reader.at88sc153ReadAR = function(icdev, zone) {
        SendCmd([READER_CMD._reader_cmd_153_read_ar, icdev, zone]);
    };

    /**
     * 写 AT88SC153 卡的 AR (用户区访问权限寄存器)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} zone 要写 AR 的用户区: 0 ~ 2.
     * @param {number} ar 要写入的 AR 的值
     */
    reader.at88sc153WriteAR = function(icdev, zone, ar) {
        SendCmd([READER_CMD._reader_cmd_153_write_ar, icdev, zone, ar]);
    };

    /**
     * 读 AT88SC153 卡的 DCR (设备配置寄存器)
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {numer} 读取到的 DCR 的值
     */
    reader.at88sc153ReadDCR = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_153_read_dcr, icdev]);
    };

    /**
     * 写 AT88SC153 卡的 DCR (设备配置寄存器)
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} dcr 要写入的 DCR 的值.
     */
    reader.at88sc153WriteDCR = function(icdev, dcr) {
        SendCmd([READER_CMD._reader_cmd_153_write_dcr, icdev, dcr]);
    };

    /**
     * 读 AT88SC153 卡的熔断标志, 熔断标志 fuse 占一个字节, 低三位分别为 FAB, CMA, PER. 如果全为 1 表示所有的存储空间可读写,  如果为 0 表示已熔断, 不可逆.
     * FAB 为 ATMEL 的芯片出厂时的熔断标志; CMA 为卡厂的卡片出厂时的熔断标志; PER 为应用系统启动前个人化时的熔断标志。
     * 在将芯片运送到卡制造商之前, ATMEL 做 FAB 熔断操作, 使 FAB = 0.
     * 在将卡运送到发卡机构之前, 卡厂写入自己的卡商代码, 做 CMA 熔断操作, 使 CMA = 0.
     * 将卡运送给最终用户之前，发行机构会做 PER 熔断操作，使 PER = 0.
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {number} 读取到的熔断标志的值
     */
    reader.at88sc153ReadFuse = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_153_read_fuse, icdev]);
    };

    /**
     * 写 AT88SC153 卡的熔断标志
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} fuse 要写入的熔断标志的值, FAB, CMA, PER 必须依次熔断
     */
    reader.at88sc153WriteFuse = function(icdev, fuse) {
        SendCmd([READER_CMD._reader_cmd_153_write_fuse, icdev, fuse]);
    };

    /**
     * AT88SC153 卡个人化（熔断操作, 使 PER = 0)
     * @param {number} icdev 连接读写器返回的句柄
     */
    reader.at88sc153Psnl = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_153_psnl, icdev]);
    };

    /*********** 特殊应用卡操作 ***********************************************************************/
    /**
     * 读磁条卡数据
     * @param {number} icdev 连接读写器返回的句柄
     * @param {number} timeout 超时时间, 单位为秒. 在此时间内如果没有刷卡, 将返回超时错误
     * @returns {string} 读取到的磁条卡 1, 2, 3 三个磁道上的数据, 分别用 # 号隔开
     */
    reader.magneticStripRead = function(icdev, timeout) {
        SendCmd([READER_CMD._reader_cmd_mag_read, icdev, timeout]);
    };

    /**
     * 读取身份证信息
     * @param {number} icdev 连接读写器返回的句柄
     * @param {string} imgPath 身份证图片存放绝对路径, 包含文件名, 后缀.bmp, 如"D:\id.bmp"
     * @returns {string} 读取到的信息, 分别为姓名, 性别, 名族, 出生日期, 身份证号, 地址, 发证机关及有效期, 用 # 号隔开
     */
    reader.identityRead = function(icdev, imgPath) {
        SendCmd([READER_CMD._reader_cmd_identity_read, icdev, imgPath]);
    };

    /**
     * 读社保卡基本信息
     * @param {number}} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的信息, 分别为社保卡号, 姓名, 性别, 名族, 身份证号及出生日期, 用 # 号隔开
     */
    reader.socialSecurityReadInfo = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_ssc_read, icdev]);
    };

    /**
     * 读健康卡号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的健康卡号
     */
    reader.healthReadNumber = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_hc_read, icdev]);
    };

    /**
     * 读银行卡/信用卡号
     * @param {number} icdev 连接读写器返回的句柄
     * @returns {string} 读取到的读银行卡或信用卡号
     */
    reader.bankReadNumber = function(icdev) {
        SendCmd([READER_CMD._reader_cmd_bc_read, icdev]);
    };

    return reader;
}

//https://www.jianshu.com/p/5507b3a85cc5
function EventTarget() {
    // 消息容器，用来存放消息和要对应的操作函数
    this.handlers = {};
}

EventTarget.prototype = {
    constructor: EventTarget,
    // 添加注册消息接口
    addEvent: function(type, func) {
        // 当消息不存在时，创建一个该消息类型，将回调函数推入执行队列中
        if (typeof this.handlers[type] === 'undefined') {
            this.handlers[type] = [func];
        } else {
            // 消息类型存在时，将回调函数推入执行队列中
            this.handlers[type].push(func);
        }
    },
    // 发布消息接口
    fireEvent: function(type, event) {
        // 当消息不存在时直接返回
        if (!this.handlers[type])
            return;

        if (!event.target) {
            event.target = this;
        }

        // 依次执行消息对应的动作队列
        for (var i = 0, len = this.handlers[type].length; i < len; i++) {
            this.handlers[type][i].call(this, event)
        }
    },
    // 移除消息接口
    removeEvent: function(type, handler) {
        if (this.handlers[type] instanceof Array) {
            var handlers = this.handlers[type];
            // 开始遍历，如果存在该动作则将其移除
            for (var i = 0; i < handlers.length; i++) {
                if (handlers[i] === handler) {
                    break;
                }
            }
            handlers.splice(i, 1);
        }
    }
};

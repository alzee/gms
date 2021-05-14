let msg = {value: ''}
var icdev = 0; //设备句柄
var reader = getReader(); //获取reader对象, getReader会自动连接ReaderService服务
if (reader == null) {
  alert('您的浏览器不支持读写器服务.');
}
var snrb; //typeB返回的序列号
var counter;
var icode2Uid;
var uhfEpc;
//回调, ret 包含三个属性, functionId, result 及 resultData. 
//functionId 为函数 id (READER_CMD 中的属性), 确定返回的是哪个命令执行的结果
//result 为执行结果, 0 成功, 其它失败,
//当 result 为 0 时 resultData 为返回结果, 当 result 不为 0 时, resultData 为错误信息
reader.onResult(function (ret) {
  //执行成功
  if (ret.result == 0) {
    switch (ret.functionId) {
      case READER_CMD._reader_server_connect:
        // auto connect
        connectUsbReader();
        // alert('读写器服务连接成功.');
        break;
      case READER_CMD._reader_cmd_connect:
        icdev = parseInt(ret.resultData); //连接成功后, resultData 为设备句柄
        // auto TypeA 寻卡
        rfCardTypeA();
        msg.value = msg.value + "读写器连接成功.\n";
        break;
      case READER_CMD._reader_cmd_disconnect:
        msg.value = msg.value + "读写器断开连接成功.\n";
        break;
      case READER_CMD._reader_cmd_read_ver:
        msg.value = msg.value + "硬件版本号: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_read_snr:
        msg.value = msg.value + "产品序列号: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_beep:
        //msg.value = msg.value + "读写器鸣响成功.\n";
        break;
      case READER_CMD._reader_cmd_set_baud:
        msg.value = msg.value + "设置串口波特率成功.\n";
        break;
      case READER_CMD._reader_cmd_get_status:
        var status = parseInt(ret.resultData);
        if (status == 0) {
          msg.value = msg.value + "大卡座中无卡.\n";
        } else {
          msg.value = msg.value + "大卡座中有卡.\n";
        }
        break;
      case READER_CMD._reader_cmd_write_eeprom:
        msg.value = msg.value + "写 EEPROM 成功.\n";
        break;
      case READER_CMD._reader_cmd_read_eeprom:
        msg.value = msg.value + "读 EEPROM 成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_set_number:
        msg.value = msg.value + "设置读写器编号成功.\n";
        break;
      case READER_CMD._reader_cmd_get_number:
        msg.value = msg.value + "读写器编号为: " + ret.resultData + ".\n";
        break;
      case READER_CMD._reader_cmd_turn_on:
        msg.value = msg.value + "大卡座上电成功.\n";
        break;
      case READER_CMD._reader_cmd_turn_off:
        msg.value = msg.value + "大卡座下电成功.\n";
        break;
      case READER_CMD._reader_cmd_rf_reset:
        msg.value = msg.value + "射频头复位成功.\n";
        break;
      case READER_CMD._reader_cmd_select_protocol:
        msg.value = msg.value + "选择协议成功.\n";
        break;
      case READER_CMD._reader_cmd_rf_card:
      case READER_CMD._reader_cmd_rf_card_b:
        // auto authen
        mifareAuthenticationKey();
        msg.value = msg.value + "寻卡成功, 卡片序列号: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_rf_halt:
      case READER_CMD._reader_cmd_rf_halt_b:
        msg.value = msg.value + "终止卡片操作成功.\n";
        break;
      case READER_CMD._reader_cmd_m_auth_key:
        // auto read carf
        mifareRead();
        msg.value = msg.value + "S50/S70 校验密码成功.\n";
        break;
      case READER_CMD._reader_cmd_m_write:
        msg.value = msg.value + "S50/S70 写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_m_read:
        msg.value = msg.value + "S50/S70 读数据成功. 读取到的数据: " + ret.resultData + "\n";
        // get data
        let a = document.querySelector('#caModal #modal-confirm');
        a.classList.remove('disabled');
        console.log(ret.resultData);
        break;
      case READER_CMD._reader_cmd_m_init_value:
        msg.value = msg.value + "S50/S70 初始化值成功.\n";
        break;
      case READER_CMD._reader_cmd_m_read_value:
        var val = parseInt(ret.resultData);
        msg.value = msg.value + "S50/S70 读值成功. 读取到的值:" + val + ".\n";
        break;
      case READER_CMD._reader_cmd_m_increment_value:
        msg.value = msg.value + "S50/S70 加值成功.\n";
        break;
      case READER_CMD._reader_cmd_m_decrement_value:
        msg.value = msg.value + "S50/S70 减值成功.\n";
        break;
      case READER_CMD._reader_cmd_c_cpu_reset:
        msg.value = msg.value + "非接触式 TypeA CPU 卡复位成功. 复位信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_c_cpu_reset_b:
        msg.value = msg.value + "非接触式 TypeB CPU 卡复位成功.\n";
        break;
      case READER_CMD._reader_cmd_c_cpu_Transmit:
        msg.value = msg.value + "非接触式 CPU 卡发送指令成功. 卡片应答信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_uc_auth_key:
        msg.value = msg.value + "Ultralight C 校验密码成功.\n";
        break;
      case READER_CMD._reader_cmd_uev_auth_key:
        msg.value = msg.value + "Ultralight EV 校验密码成功.\n";
        break;
      case READER_CMD._reader_cmd_u_read:
        msg.value = msg.value + "Ultralight / Ultralight C 读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_u_write:
        msg.value = msg.value + "Ultralight / Ultralight C 写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_uc_change_key:
        msg.value = msg.value + "更改  Ultralight C 密码成功.\n";
        break;
      case READER_CMD._reader_cmd_ntag_auth_pwd:
        msg.value = msg.value + "校验 NTAG213/215/216 密码成功.\n";
        break;
      case READER_CMD._reader_cmd_ntag_read:
        msg.value = msg.value + "NTAG213/215/216 读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_ntag_write:
        msg.value = msg.value + "NTAG213/215/216 写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_ntag_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "读 NTAG213/215/216 单向计数器的值成功. 计数器的值: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_ntag_version:
        msg.value = msg.value + "读 NTAG213/215/216 版本信息成功. 版本信息数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_ntag_sig:
        msg.value = msg.value + "读 NTAG213/215/216 签名信息成功. 签名信息数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_icode2_set_mode:
        msg.value = msg.value + "设置数据交换模式成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_inventory:
        var tags = ret.resultData.split('#');
        msg.value = msg.value + "共查询到 " + tags.length + "张标签.\n";
        for (var i = 0; i < tags.length; i++) {
          var tagInfo = tags[i].split('*');
          var dsfid = parseInt(tagInfo[0]); //获取dsfid的值
          msg.value = msg.value + "DSFID: " + dsfid + "; UID: " + tagInfo[1] + ".\n";
          if (i == 0) {
            icode2Uid = tagInfo[1]; //保存第一张标签的 UID, 读写数据需要用到
          }
        }
        break;
      case READER_CMD._reader_cmd_icode2_select:
        msg.value = msg.value + "设置ICode2卡为选择状态成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_reset_to_ready:
        msg.value = msg.value + "使ICode2卡进入 Ready 状态成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_to_quiet:
        msg.value = msg.value + "使ICode2卡进入 Quiet 状态成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_read:
        msg.value = msg.value + "读取ICode2多个块信息成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_icode2_write:
        msg.value = msg.value + "写入 ICode2 多个块信息成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_write_afi:
        msg.value = msg.value + "写 AFI 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_write_dsfid:
        msg.value = msg.value + "写 DSFID 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_set_eas:
        msg.value = msg.value + "设置 EAS 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_lock:
        msg.value = msg.value + "锁定数据块成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_lock_afi:
        msg.value = msg.value + "锁定 AFI 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_lock_dsfid:
        msg.value = msg.value + "锁定 DSFID 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_lock_eas:
        msg.value = msg.value + "锁定 EAS 成功.\n";
        break;
      case READER_CMD._reader_cmd_icode2_get_mulblock_security:
        msg.value = msg.value + "读取到的安全状态信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_icode2_get_sysinfo:
        msg.value = msg.value + "读取到的 ICODE2 系统信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_uhf_inventory:
        var uhfTag = ret.resultData.split('#');
        msg.value = msg.value + "查找超高频标签成功. 查找到的标签信息: \n";
        msg.value = msg.value + "RSSI: " + uhfTag[0] + "\nCRC: " + uhfTag[1] + "\nPC: " + uhfTag[2] + "\nEPC: " + uhfTag[3] + ".\n";
        uhfEpc = uhfTag[3]; //保存epc
        break;
      case READER_CMD._reader_cmd_uhf_select_mode:
        msg.value = msg.value + "设置超高频选择模式成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_select:
        msg.value = msg.value + "选择超高频标签成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_read:
        msg.value = msg.value + "读超高频标签数据存储区成功. 读取到的数据: " + ret.resultData.split('#')[0] + "\n";
        break;
      case READER_CMD._reader_cmd_uhf_write:
        msg.value = msg.value + "写超高频标签数据存储区成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_lock_unlock:
        msg.value = msg.value + "锁定或解锁超高频数据存储区成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_kill:
        msg.value = msg.value + "灭活超高频标签成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_region:
        msg.value = msg.value + "设置读写器工作地区成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_channel:
        msg.value = msg.value + "设置超高频工作信道成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_get_channel:
        var chIndex = parseInt(ret.resultData);
        msg.value = msg.value + "获取超高频工作信道成功. 信道代码: " + chIndex + "\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_hfss:
        msg.value = msg.value + "设置自动跳频成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_papower:
        msg.value = msg.value + "设置超高频发射功率成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_get_papower:
        var papower = parseInt(ret.resultData) / 100;
        msg.value = msg.value + "获取超高频发射功率成功. 发射功率: " + papower + "dm.\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_cw:
        msg.value = msg.value + "设置发射连续载波成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_set_modem:
        msg.value = msg.value + "设置读写器接收解调器参数成功.\n";
        break;
      case READER_CMD._reader_cmd_uhf_get_modem:
        msg.value = msg.value + "获取读写器接收解调器参数成功. 获取到的参数数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_lf_set_datarate:
        msg.value = msg.value + "设置读写器低频接收频率成功.\n";
        break;
      case READER_CMD._reader_cmd_lf_open_mod:
        msg.value = msg.value + "打开 125KHZ 射频信息成功.\n";
        break;
      case READER_CMD._reader_cmd_lf_close_mod:
        msg.value = msg.value + "关闭 125KHZ 射频信号成功.\n";
        break;
      case READER_CMD._reader_cmd_t5557_write_free:
      case READER_CMD._reader_cmd_t5557_write_pwd:
        msg.value = msg.value + "T5557 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_t5557_read_direct:
        msg.value = msg.value + "T5557 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_t5557_aor:
        msg.value = msg.value + "T5557 卡唤醒成功.\n";
        break;
      case READER_CMD._reader_cmd_t5557_to_id:
        msg.value = msg.value + "T5557 卡转换成 ID 卡成功.\n";
        break;
      case READER_CMD._reader_cmd_id_restore_t5557:
        msg.value = msg.value + "将 ID 卡还原成 T5557 卡成功.\n";
        break;
      case READER_CMD._reader_cmd_em_read:
        msg.value = msg.value + "读 EM4001 或兼容 ID 卡成功. 返回卡号: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_em4305_write:
        msg.value = msg.value + "EM4305 写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_em4305_read_biphase:
      case READER_CMD._reader_cmd_em4305_read_manchester:
        msg.value = msg.value + "EM4305 读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_em4305_login:
        msg.value = msg.value + "EM4305 验证密码成功.\n";
        break;
      case READER_CMD._reader_cmd_em4305_protect: //锁定 EM4305 卡指定地址
        msg.value = msg.value + "EM4305 锁定数据成功.\n";
        break;
      case READER_CMD._reader_cmd_em4305_disable: //休眠 EM4305 卡 
        msg.value = msg.value + "EM4305 休眠成功.\n";
        break;
      case READER_CMD._reader_cmd_em4305_set_mode: //设置EM卡类型
        msg.value = msg.value + "设置 EM 卡类型成功. \n";
        break;
      case READER_CMD._reader_cmd_em4305_to_id:
        msg.value = msg.value + "EM4305 转换成 ID 卡成功.\n";
        break;
      case READER_CMD._reader_cmd_em4305_to_fdxb: //把 EM4305 格式化成 FDX_B 卡
        msg.value = msg.value + "EM4305 转换为 FDX_B 卡成功.\n";
        break;
      case READER_CMD._reader_cmd_cpu_reset: //接触cpu复位
        msg.value = msg.value + "接触 CPU 卡复位成功. 卡片返回复位信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_cpu_transmit:
        msg.value = msg.value + "接触 CPU 卡发送命令成功. 卡片返回应答信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_cpu_set_baud:
        msg.value = msg.value + "设置接触式 CPU 卡波特率成功.\n";
        break;
      case READER_CMD._reader_cmd_24c_write:
        msg.value = msg.value + "AT24C 系列卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_24c_read:
        msg.value = msg.value + "AT24C 系列卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_45D041_write:
        msg.value = msg.value + "AT45D041 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_45D041_read:
        msg.value = msg.value + "AT45D041 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4442_read:
        msg.value = msg.value + "SLE4442 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4442_write:
        msg.value = msg.value + "SLE4442 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_4442_verify_sc:
        msg.value = msg.value + "SLE4442 卡验证密码成功.\n";
        break;
      case READER_CMD._reader_cmd_4442_change_sc:
        msg.value = msg.value + "SLE4442 卡更改密码成功.\n";
        break;
      case READER_CMD._reader_cmd_4442_read_sc:
        msg.value = msg.value + "SLE4442 卡读取密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4442_read_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "SLE4442 卡读取密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_4442_read_pro_bit:
        msg.value = msg.value + "SLE4442 卡读保护位成功. 读取到保护位数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4442_protect:
        msg.value = msg.value + "SLE4442 卡保护数据成功.\n";
        break;
      case READER_CMD._reader_cmd_4428_read:
        msg.value = msg.value + "SLE4428 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4428_write:
        msg.value = msg.value + "SLE4428 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_4428_verify_sc:
        msg.value = msg.value + "SLE4428 卡验证密码成功.\n";
        break;
      case READER_CMD._reader_cmd_4428_change_sc:
        msg.value = msg.value + "SLE4442 卡更改密码成功.\n";
        break;
      case READER_CMD._reader_cmd_4428_read_sc:
        msg.value = msg.value + "SLE4428 卡读取密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4428_read_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "SLE4428 卡读取密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_4428_read_pro:
        msg.value = msg.value + "SLE4428 卡带保护位读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_4428_write_pro:
        msg.value = msg.value + "SLE4428 卡写数据并保护成功.\n";
        break;
      case READER_CMD._reader_cmd_4428_protect:
        msg.value = msg.value + "SLE4428 卡保护数据成功.\n";
        break;
      case READER_CMD._reader_cmd_102_read:
        msg.value = msg.value + "AT88SC102 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_102_write:
        msg.value = msg.value + "AT88SC102 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_102_erase:
        msg.value = msg.value + "AT88SC102 卡擦除数据成功.\n";
        break;
      case READER_CMD._reader_cmd_102_verify_sc:
        msg.value = msg.value + "AT88SC102 卡验证用户密码成功.\n";
        break;
      case READER_CMD._reader_cmd_102_change_sc:
        msg.value = msg.value + "AT88SC102 卡更改用户密码成功.\n";
        break;
      case READER_CMD._reader_cmd_102_read_sc:
        msg.value = msg.value + "AT88SC102 卡读取用户密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_102_read_sc_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC102 卡读取用户密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_102_verify_erase_key:
        msg.value = msg.value + "AT88SC102 卡校验擦除密码成功.\n";
        break;
      case READER_CMD._reader_cmd_102_change_erase_key:
        msg.value = msg.value + "AT88SC102 卡更改擦除密码成功.\n";
        break;
      case READER_CMD._reader_cmd_102_read_erase_key:
        msg.value = msg.value + "AT88SC102 卡读取擦除密码成功. 读取到的擦除密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_102_read_erase_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC102 卡读取应用二区擦除计数成功. 擦除计数: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_102_PR_RD_clear:
        msg.value = msg.value + "AT88SC102 读写属性控制位清零成功.\n";
        break;
      case READER_CMD._reader_cmd_102_simulate_psnl:
        msg.value = msg.value + "AT88SC102 卡模拟个人化/取消模拟个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_102_psnl:
        msg.value = msg.value + "AT88SC102 卡个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_read:
        msg.value = msg.value + "AT88SC1604 卡读数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1604_write:
        msg.value = msg.value + "AT88SC1604 卡写数据成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_erase:
        msg.value = msg.value + "AT88SC1604 卡擦除数据成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_verify_sc:
        msg.value = msg.value + "AT88SC1604 卡验证密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_change_sc:
        msg.value = msg.value + "AT88SC1604 卡更改密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_read_sc:
        msg.value = msg.value + "AT88SC1604 卡读取密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1604_read_sc_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC1604 卡读取密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_1604_verify_erase_key:
        msg.value = msg.value + "AT88SC1604 卡验证擦除密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_change_erase_key:
        msg.value = msg.value + "AT88SC1604 卡更改擦除密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_read_erase_key:
        msg.value = msg.value + "AT88SC1604 卡读取擦除密码成功. 读取到的擦除密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1604_read_erase_key_counter:
        msg.value = msg.value + "AT88SC1604 卡读取擦除密码错误计数成功. 擦除密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_1604_PR_RD_clear:
        msg.value = msg.value + "AT88SC1604 读写属性控制位清零成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_simulate_psnl:
        msg.value = msg.value + "AT88SC1604 卡模拟个人化/取消模拟个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_1604_psnl:
        msg.value = msg.value + "AT88SC1604 卡个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_reset:
        msg.value = msg.value + "AT88SC1608 卡复位成功, 返回复位信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1608_read_user:
        msg.value = msg.value + "AT88SC1608 卡读用户区数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1608_write_user:
        msg.value = msg.value + "AT88SC1608 卡写用户区数据成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_read_config:
        msg.value = msg.value + "AT88SC1608 卡读配置区数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1608_write_config:
        msg.value = msg.value + "AT88SC1608 卡写配置区数据成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_verify_pwd:
        msg.value = msg.value + "AT88SC1608 卡校验密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_change_pwd:
        msg.value = msg.value + "AT88SC1608 卡更改密码成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_read_pwd:
        msg.value = msg.value + "AT88SC1608 卡读密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_1608_read_pwd_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC1608 卡读取密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_1608_read_ar:
        var _1608ar = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC1608 卡读取 AR 成功. AR 的值为: " + _1608ar + "\n";
        break;
      case READER_CMD._reader_cmd_1608_write_ar:
        msg.value = msg.value + "AT88SC1608 卡写 AR 成功.\n";
        break;
      case READER_CMD._reader_cmd_1608_read_fuse:
        var _1608fuse = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC1608 卡读取熔断标志成功. 读取到的熔断标志: " + _1608fuse + "\n";
        break;
      case READER_CMD._reader_cmd_1608_psnl:
        msg.value = msg.value + "AT88SC1608 卡个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_153_reset:
        msg.value = msg.value + "AT88SC153 卡复位成功, 返回复位信息: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_153_read_user:
        msg.value = msg.value + "AT88SC153 卡读用户区数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_153_write_user:
        msg.value = msg.value + "AT88SC153 卡写用户区数据成功.\n";
        break;
      case READER_CMD._reader_cmd_153_read_config:
        msg.value = msg.value + "AT88SC153 卡读配置区数据成功. 读取到的数据: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_153_write_config:
        msg.value = msg.value + "AT88SC153 卡写配置区数据成功.\n";
        break;
      case READER_CMD._reader_cmd_153_verify_pwd:
        msg.value = msg.value + "AT88SC153 卡校验密码成功.\n";
        break;
      case READER_CMD._reader_cmd_153_change_pwd:
        msg.value = msg.value + "AT88SC153 卡更改密码成功.\n";
        break;
      case READER_CMD._reader_cmd_153_read_pwd:
        msg.value = msg.value + "AT88SC153 卡读密码成功. 读取到的密码: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_153_read_pwd_counter:
        counter = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC153 卡读取密码错误计数成功. 密码错误计数为: " + counter + "\n";
        break;
      case READER_CMD._reader_cmd_153_read_ar:
        var _153ar = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC153 卡读取 AR 成功. AR 的值为: " + _153ar + "\n";
        break;
      case READER_CMD._reader_cmd_153_write_ar:
        msg.value = msg.value + "AT88SC153 卡写 AR 成功.\n";
        break;
      case READER_CMD._reader_cmd_153_read_dcr:
        var _153dcr = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC153 卡读取 DCR 成功. DCR 的值为: " + _153dcr + "\n";
        break;
      case READER_CMD._reader_cmd_153_write_dcr:
        msg.value = msg.value + "AT88SC153 卡写 DCR 成功.\n";
        break;
      case READER_CMD._reader_cmd_153_read_fuse:
        var _153fuse = parseInt(ret.resultData);
        msg.value = msg.value + "AT88SC153 卡读取熔断标志成功. 读取到的熔断标志: " + _153fuse + "\n";
        break;
      case READER_CMD._reader_cmd_153_write_fuse:
        msg.value = msg.value + "AT88SC153 卡写熔断标志成功.\n";
        break;
      case READER_CMD._reader_cmd_153_psnl:
        msg.value = msg.value + "AT88SC153 卡个人化成功.\n";
        break;
      case READER_CMD._reader_cmd_mag_read:
        var magData = ret.resultData.split('#');
        msg.value = msg.value + "1 轨数据: " + magData[0] + "; 2 轨数据: " + magData[1] + "; 3 轨数据: " + magData[2] + ".\n";
        break;
      case READER_CMD._reader_cmd_identity_read:
        var idInfo = ret.resultData.split('#');
        msg.value = msg.value + "姓名: " + idInfo[0] + "\n" + "性别: " + idInfo[1] + "\n" + "名族: " + idInfo[2] + "\n" + "出生日期: " + idInfo[3] + "\n" +
          "身份证号: " + idInfo[4] + "\n" + "地址: " + idInfo[5] + "\n" + "发证机关: " + idInfo[6] + "\n" + "有效期: " + idInfo[7] + "\n";
        break;
      case READER_CMD._reader_cmd_ssc_read:
        var sscInfo = ret.resultData.split('#');
        msg.value = msg.value + "社保卡号: " + sscInfo[0] + "\n" + "姓名: " + sscInfo[1] + "\n" + "性别: " + sscInfo[2] + "\n" +
          "名族: " + sscInfo[3] + "\n" + "身份证号: " + sscInfo[4] + "\n" + "出生日期: " + sscInfo[5] + "\n";
        break;
      case READER_CMD._reader_cmd_hc_read:
        msg.value = msg.value + "读健康卡号: " + ret.resultData + "\n";
        break;
      case READER_CMD._reader_cmd_bc_read:
        msg.value = msg.value + "读银行卡/信用卡号: " + ret.resultData + "\n";
        break;
    }
  } else {
    //失败打印错误信息
    msg.value = msg.value + ret.resultData + "\n";
  }
    console.log(msg.value);
});

//连接串口读写器
function connectReader() {
  try {
    reader.connectSerialPort(2, 115200); //连接串口设备, 串口号 COM3, 波特率115200
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//连接USB读写器
function connectUsbReader() {
  try {
    reader.connectUsb(); //连接usb设备
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//按照编号连接usb设备
function connectUsbNumberReader() {
  try {
    reader.connectUsbNumber(5); //编号5
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//断开连接的读写器
function disconnectReader() {
  try {
    reader.disconnect(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读硬件版本号
function readVer() {
  try {
    reader.readHardwareVersion(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读产品序列号
function readSerialNumber() {
  try {
    reader.readProductSerialNumber(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读写器鸣响
function readerBeep() {
  try {
    reader.readerBeep(icdev, 30);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//写EEPROM
function writeEEPROM() {
  try {
    reader.writeEEPROM(icdev, 0, '1234567890abcdef');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读EEPROM
function readEEPROM() {
  try {
    reader.readEEPROM(icdev, 0, 8);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//设置USB读写器编号 
function setUsbNumber() {
  try {
    reader.setUsbReaderNumber(icdev, 5); //编号设置为5
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//获取USB读写器编号 
function getUsbNumber() {
  try {
    reader.getUsbReaderNumber(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

//////////////////////////// 高频卡 (13.56MHZ) ////////////////////////////
//TypeA 寻卡
function rfCardTypeA() {
  try {
    reader.rfCard(icdev, 1);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//验证密码
function mifareAuthenticationKey() {
  try {
    //验证A密码, 1扇区
    reader.mifareAuthenticationKey(icdev, 0, 1, 'ffffffffffff');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//写数据
function mifaerWrite() {
  try {
    //写 4  块数据
    // reader.mifareWrite(icdev, 4, '1234567890abcdef');
    reader.mifareWrite(icdev, 4, 'A001000000000000');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读数据
function mifareRead() {
  try {
    //读取 4  块数据
    reader.mifareRead(icdev, 4);
  } catch (e) {
    console.log(e);
    msg.value = msg.value + e.Message + "\n";
  }
}
//初始化值
function mifareInitValue() {
  try {
    //初始化 5 块值
    reader.mifareInitValue(icdev, 5, 1000);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//加值
function mifareIncrementValue() {
  try {
    //对 5 块加值
    reader.mifareIncrementValue(icdev, 5, 100);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//减值
function mifareDecrementValue() {
  try {
    //对 5 块减值
    reader.mifareDecrementValue(icdev, 5, 200);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//读值
function mifareReadValue() {
  try {
    //读取 5 块的值
    reader.mifareReadValue(icdev, 5);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function rfHalt() {
  try {
    reader.rfHalt(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//TypeB寻卡
function rfCardB() {
  try {
    reader.rfCardB(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//TypeB停止操作
function rfHaltB() {
  try {
    reader.rfHaltB(icdev, snrb);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//TypeA cpu复位
function mifareCpuReset() {
  try {
    reader.mifareCpuReset(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

//TypeB cpu复位
function mifareCpuResetB() {
  try {
    reader.mifareCpuResetB(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//非接cpu卡发送命令 TypeA/TypeB
function mifareCpuTransmit() {
  try {
    reader.mifareCpuTransmit(icdev, '0084000008');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

//接触CPU复位
function cpuReset() {
  try {
    reader.cpuReset(icdev, 0); //大卡座复位
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//接触cpu卡发送命令
function cpuTransmit() {
  try {
    reader.cpuTransmit(icdev, 0, '0084000008'); //大卡座发送命令
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}
//接触卡设置波特率
function cpuSetBaud() {
  try {
    reader.cpuSetBaud(icdev, 0, 9600); //设置波特率为9600
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

////////////////////// ICODE2 ////////////////////
function selectIcode2Protocol() {
  try {
    reader.selectProtocol(icdev, 2);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function icode2Inventory() {
  try {
    reader.icode2Inventory(icdev, 0, 0, 0);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function icode2Read() {
  try {
    reader.icode2Read(icdev, 0, 1, 0, 0, 5, icode2Uid); //从 0 块开始连续读取 5 个块的数据, 需要 UID 匹配
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function icode2Write() {
  try {
    reader.icode2Write(icdev, 0, 1, 0, 5, icode2Uid, '1234567890ABCDEF1234567890ABCDEF12345678'); //从 0 块开始连续写 5 个块的数据, 需要 UID 匹配
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

/////////////////////// 超高频标签 //////////////////////////////
function uhfInventory(){
  try {
    reader.uhfInventory(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function uhfSelect(){
  try {
    reader.uhfSelect(icdev, uhfEpc);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function uhfWrite(){
  try {
    //Access Password未启用时可传入任意值
    //写用户区，从 2 word 开始写, 每 4 个字符为 1 个word, 写入 4 word的数据
    //实际写入从 2 word 到 6 word 地址（索引 4 ~ 12 byte)
    //回调函数中返回当前标签的 EPC 及 EPC
    reader.uhfWrite(icdev, '00000000', 3, 2, '1234567890ABCDEF');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function uhfRead(){
  try {
    //读取写入的数据, //回调函数中返回读取到的数据, 当前标签的 EPC 及 EPC
    reader.uhfRead(icdev, '00000000', 3, 2, 4);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function uhfKill(){
  try {
    //如果kill password没有设置过, 标签不会被kill, 即kill会失败
    reader.uhfKill(icdev, '00000000');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

/////////////////////// 低频 t5557 卡 /////////////////////// 
function openMod() {
  try {
    reader.lfOpenMod(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function closeMod() {
  try {
    reader.lfCloseMod(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function t5557Write() {
  try {
    reader.t5557WriteFree(icdev, 0, 1, 0, '12345678'); //用户区 1 页写入数据
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function t5557Read() {
  try {
    reader.t5557ReadDirect(icdev, 0, 1, 0, '00000000'); //读用户区 1 页数据
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function t5557ToIDCard() {
  try {
    reader.t5557toID(icdev, '1234567890');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function idToT5557() {
  try {
    reader.idRestoreT5557(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function readIdCard() {
  try {
    reader.em4001Read(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

////////////////////// SLE4442 /////////////////////////
function sle4442VerifySC() {
  try {
    reader.sle4442VerifySC(icdev, 'ffffff');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function sle4442ChangeSC() {
  try {
    reader.sle4442ChangeSC(icdev, '123456');
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function sle4442Read() {
  try {
    reader.sle4442Read(icdev, 32, 224);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function sle4442Write() {
  try {
    var s = '';
    for (var n = 32; n < 256; n++) {
      s += n.toString(16);
    }
    reader.sle4442Write(icdev, 32, s);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function sle4442ReadCounter() {
  try {
    reader.sle4442ReadCounter(icdev);
  } catch (e) {
    msg.value = msg.value + e.Message + "\n";
  }
}

function read(){
    let i = 0;
    const intvl = setInterval(
        () => {
            rfCardTypeA();
            if (i === 5) {
                clearInterval(intvl);
            }
            i += 1;
        }
        ,1000);
}

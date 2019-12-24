
<link rel="stylesheet" href="<?=$uri?>/templates/css/chat.css?<?=filemtime('templates/css/chat.css')?>" type="text/css"/>


<body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="<?=$uri?>/templates/js/chat.js?<?=filemtime('templates/js/chat.js')?>"></script>

<div class="chat_wrapper">
    <div class="message_box" id="message_box"></div>
    <div class="panel">
        <input type="text" name="message" id="message" placeholder="Message" maxlength="80" />
        <button id="send-btn">Send</button>
    </div>
</div>
</body>

<template id="system_msg">
    <tr>
        <td class="system_msg"></td>
    </tr>
</template>

<template id="usersmsg">
    <div class="usersmsg">
        <span class="userTime"></span>
        <span class="userName"></span>
        <span class ="userMsg"></span>
    </div>
</template>

<template id="mymsg">
    <div class="mymsg">
        <span class="myTime"></span>
        <span class="myName"></span>
        <span class="myMessage"></span>
    </div>
</template>

$(document).ready(function(){
    var server_ip = window.document.location.host;
    var url="http://" + server_ip + "/gizmos.php";
    var handle="gizmos.php";
    $("#but_gen_hash").click( function() {
        var is_ok = true;
        if ("" == $("#id_will_hash_str").val()) {
            is_ok = false;
            alert("Need some strings!");
        }
        if (is_ok) {
            $.post(handle, {
                    how:'gen_hash',
                    hash_str:$("#id_will_hash_str").val(),
                },
                function(data,status){
                    if ("success" == status) {
                        $("#v_crc32").html(data.crc32);
                        $("#v_l_md5_16").html(data.md5_16);
                        $("#v_u_md5_16").html(data.md5_16.toUpperCase());
                        $("#v_l_md5_32").html(data.md5_32);
                        $("#v_u_md5_32").html(data.md5_32.toUpperCase());
                        $("#v_l_sha1").html(data.sha1);
                        $("#v_u_sha1").html(data.sha1.toUpperCase());
                    }
                    else {
                        alert("Not OK!");
                    }
                }, "json"
            );
        }
    });
    $("#but_encode").click( function() {
        var is_ok = true;
        if ("" == $("#id_code_str").val()) {
            is_ok = false;
            alert("Need some strings!");
        }
        if (is_ok) {
            $.post(handle, {
                    how:'encode',
                    code_str:$("#id_code_str").val(),
                },
                function(data,status){
                    if ("success" == status) {
                        $("#v_urlencode").html(data.urlencode);
                        $("#v_base64en").html(data.base64en);
                    }
                    else {
                        alert("Not OK!");
                    }
                }, "json"
            );
        }
    });
    $("#but_decode").click( function() {
        var is_ok = true;
        if ("" == $("#id_code_str").val()) {
            is_ok = false;
            alert("Need some strings!");
        }
        if (is_ok) {
            $.post(handle, {
                    how:'decode',
                    code_str:$("#id_code_str").val(),
                },
                function(data,status){
                    if ("success" == status) {
                        $("#v_urldecode").html(data.urldecode);
                        $("#v_base64de").html(data.base64de);
                    }
                    else {
                        alert("Not OK!");
                    }
                }, "json"
            );
        }
    });
    $("#but_crypt").click( function() {
        var is_ok = true;
        if ("" == $("#id_pswd_str").val()) {
            is_ok = false;
            alert("Need some strings!");
        }
        if (is_ok) {
            $.post(handle, {
                    how:'crypt',
                    crypt_method:$("#id_crypt_method").val(),
                    salt:$("#id_salt_str").val(),
                    pswd_str:$("#id_pswd_str").val(),
                },
                function(data,status){
                    if ("success" == status) {
                        $("#v_pswd").html(data.pswd);
                    }
                    else {
                        alert("Not OK!");
                    }
                }, "json"
            );
        }
    });
});

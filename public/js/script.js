window.onload = function() {
    App = new App();
    
};

class App {
    constructor() {
        // 회원가입시 파일
        $("#file").on('change', (e)=>{
            var filename = $(e.target).val().split('/').pop().split('\\').pop(); // 파일명만 추출 
    
            $('.upload-name').val(filename);
        });
    }

}

function logincheck() {
    let id = $("input[name='id'");
    let pw = $("input[name='pw'");

    if(id.val() == "") {
        alert("아이디가 비워져있습니다.");
        id.focus();
        return;
    }
    
    if(pw.val() == "") {
        alert("비밀번호가 비워져있습니다.");
        pw.focus();
        return;
    }
    
    $("input[type='submit']").click();
}
function checkEmail(str){                                              

    var reg_email = /^([0-9a-zA-Z_\.-]+)@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;

    if(!reg_email.test(str)) {                           
        return false;    
    } else {                       
        return true;         
    }                            

}


function regicheck() {
    let id = $("input[name='id'");
    let name = $("input[name='name']");
    let email = $("input[name='email']");
    let pw = $("input[name='pw']");
    let pwcheck = $("input[name='pwcheck']");
    let file = $("input[name='file']");

    if(id.val() == "") {
        alert("아이디가 비워져있습니다.");
        id.focus();
        return;
    }
    
    if(name.val() == "") {
        alert("이름이 비워져있습니다.");
        name.focus();
        return;
    }
    
    if(email.val() == ""){
        alert("이메일 값이 비워져있습니다.");
        email.focus();
        return;
    }else {
        if(!checkEmail(email.val())) {
            alert("이메일형식이 잘못되었습니다.");
            email.focus();
            return;
        }
    }

    if(pw.val() == "") {
        alert("비밀번호가 비워져있습니다.");
        pw.focus();
        return;
    }
    
    if(pwcheck.val() == "") {
        alert("비밀번호 확인란이 비워져있습니다.");
        pwcheck.focus();
        return;
    }

    if(pw.val() != pwcheck.val()) {
        alert("비밀번호확인란의 값이 비밀번호의 값과 다릅니다.");
        pwcheck.focus();
        return;
    }

    if(file.val() =="") {
        alert("회원 프로필 사진값이 비워져있습니다.");
        $(".upload-name").focus();
        return;
    }

    let pattern = /[^a-zA-Z]/;
    let exp = RegExp(/[^a-zA-Z]/);
    if(exp.test(id.val())) {
        alert("영어만 입력가능합니다.");
        id.focus();
        return;
    }
    if(exp.test(pw.val())) {
        alert("영어만 입력가능합니다.");
        pw.focus();
        return;
    }

    $("input[type='submit']").click();
}

function deleteBoard() {
    let confirmflag = confirm("정말로 삭제하시겠습니까?");
    if(confirmflag) {
        $("#deleteBtn").click();
    }
}

function email() {
    
}
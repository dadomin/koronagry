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

function regicheck() {
    let id = $("input[name='id'");
    let name = $("input[name='name']");
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

    $("input[type='submit']").click();
}

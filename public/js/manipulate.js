$('#gambar').click(function(){
    $('#id_gambar').addClass('animated swing');
});



function validasi() {
    var nama = document.forms["form1"]["nama"].value;
    var email = document.forms["form1"]["mail"].value;
    var pesan = document.forms["form1"]["pesan"].value;


    if (validasi_nama(nama)) {
        if (validasi_email(email)) {
            document.getElementById('nama_data').innerHTML = "Nama : "+nama;
            document.getElementById('email_data').innerHTML = "Email : "+email;
            document.getElementById('pesan_data').innerHTML = "Pesan dan kesan : "+pesan;
            $('#myModal').modal('show');
        }
    }
    return false;

    function validasi_nama(name){
        if (name == "") {
            $("div.nama").addClass( "has-error" ).removeClass( "has-success" );
            $("span.nama").addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
            document.getElementById('nama').innerHTML = "Nama tidak boleh kosong";
            return false;
        }
        $("div.nama").addClass( "has-success" ).removeClass( "has-error" );
        $("span.nama").addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
        document.getElementById("nama").innerHTML = "";        
        return true;        
    }
    
    function validasi_email(mail) {
        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if (mail.match(mailformat)) {
            $("div.email").addClass( "has-success" ).removeClass( "has-error" );
            $("span.email").addClass( "glyphicon-ok" ).removeClass( "glyphicon-remove" );
            document.getElementById("email").innerHTML = "";
            return true;
        }
        $("div.email").addClass( "has-error" ).removeClass( "has-success" );
        $("span.email").addClass( "glyphicon-remove" ).removeClass( "glyphicon-ok" );
        document.getElementById("email").innerHTML = "Email tidak valid!!";
        return false;
    }
    
}



$('#id_gambar').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', 
    $('#id_gambar').removeClass('animated')); //belum berhasil
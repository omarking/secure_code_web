function conexion() {

    var mysql = require('../../mysql');
    var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "locateme"
    });

    con.connect(function(err) {
        if (err) throw err;
        //Select all customers and return the result object:
        con.query("SELECT identidades_emergencia as 'CLAVE_ENTIDAD', enti_descripcion as 'DESCRIPCION', enti_telefono as 'TELEFONO', enti_direccion as 'DIRECCION', enti_correo as 'CORREO' from entidades_emergencia where identidades_emergencia =" + val, function(err, result, fields) {
            if (err) throw err;
            console.log(result);
        });
    });


}
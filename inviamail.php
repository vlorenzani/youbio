<?
// includiamo il file di configurazione
include "include/config.php";
include "include/function.php";
if (smtpmailer('v.lorenzani@gmail.com', 'staff@youbio.info', 'Staff', 'Mail youbio.info', 'Hello World! bella pe te')) {
	// do something
}
if (!empty($error)) echo $error;
        ?>
       
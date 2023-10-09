# PHP_Hashing
Checksum &amp; Hashing library for PHP, ported from Lazarus

# PHP Port of Lazarus_Hashing
https://github.com/PascalVault/Lazarus_Hashing

## Usage example: ##

	include 'Hasher.php';
	
	$Msg = '123456789';
	
	$Hasher = new Hasher('Adler-32');
	
	$Hasher->Update($Msg, strlen($Msg));
	
	$Hash = $Hasher->Finish();
	
	echo $Hash;

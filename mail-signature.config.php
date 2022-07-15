<?php
/**
 * DKIM is used to sign e-mails. If you change your RSA key, apply modifications to
 * the DNS DKIM record of the mailing (sub)domain too !
 * Disclaimer : the php openssl extension can be buggy with Windows, try with Linux first
 * 
 * To generate a new private key with Linux :
 * openssl genrsa -des3 -out private.pem 1024
 * Then get the public key
 * openssl rsa -in private.pem -out public.pem -outform PEM -pubout
 */
// Edit with your own info :
define('MAIL_RSA_PASSPHRASE', 'myPassPhrase');
define('MAIL_RSA_PRIV',
'-----BEGIN RSA PRIVATE KEY-----
p=MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDOoaGvykJEXwsuWw8MbgbZtp4ucawiM9VHbKvxz3eFI5TW2Rgo7Ywft4zgdiW+Rt2D37UlmYlmraVttczB0fJpSo4TH3PU6cwCzWdf3shgSUuADYWPWKemGiJRXfEPr3X9lAHyZ7OffcTAjXxvGfWxdyDLBeJaJfxa/QKhPgv2EQIDAQAB
-----END RSA PRIVATE KEY-----');
define('MAIL_RSA_PUBL',
'-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDY1OGnYZA535b/bca5ZMIHxCPb
qGHVq9dFM7nE69KIJ2TO5GF55qby2SadlyucG2AZbwCPig2Or4XjbtzIkqU6UeqY
N1G7gNuOVO50HVBMp8D3nGgXDL7gmspExsK8UUGNA89YpXe/7qZ3DqqgpDfWFVcV
dTXsMH6h1mN1XYfWhwIDAQAB
-----END PUBLIC KEY-----');
// Domain or subdomain of the signing entity (i.e. the domain where the e-mail comes from)
define('MAIL_DOMAIN', 'example.com');  
// Allowed user, defaults is "@<MAIL_DKIM_DOMAIN>", meaning anybody in the MAIL_DKIM_DOMAIN
// domain. Ex: 'admin@mydomain.tld'. You'll never have to use this unless you do not
// control the "From" value in the e-mails you send.
define('MAIL_IDENTITY', NULL);
// Selector used in your DKIM DNS record, e.g. : selector._domainkey.MAIL_DKIM_DOMAIN
define('MAIL_SELECTOR', 'selector');
?>
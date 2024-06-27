<?php

// LDAP server settings
$ldapHost = 'test-dc.gov.tt'; // Your LDAP server host
$ldapPort = 389; // Default LDAP port
$ldapUser = 'CN=Jardel Regis,CN=Users,DC=test-DC,DC=gov,DC=tt'; // LDAP admin username
$ldapPassword = 'Health2021'; // LDAP admin password

// Connect to LDAP server
$ldapConn = ldap_connect($ldapHost, $ldapPort);

if (!$ldapConn) {
    die("Could not connect to LDAP server.");
}

// Bind to LDAP server
$ldapBind = ldap_bind($ldapConn, $ldapUser, $ldapPassword);

if (!$ldapBind) {
    // LDAP bind failed, get the LDAP error
    $ldapError = ldap_error($ldapConn);
    
    // Display custom error message based on LDAP error
    echo "LDAP bind failed: $ldapError";
    ldap_close($ldapConn);
    exit;
}

echo "Connected to LDAP server.";

// Perform LDAP operations here...

// Close LDAP connection
ldap_close($ldapConn);
?>

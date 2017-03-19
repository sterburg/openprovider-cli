<?php

  require_once('API.php');

  $options  = getopt("u:p::h::c:n::",array('type::','masterIp::','templateName::'));
  $username = $options['u'];
  $password = $options['p'];
  $hash     = $options['h'];
  $command  = $options['c'];
  $name     = $options['n'];
  $domain   = explode('.', $name);
  $domain   = array('name' => $domain[0], 'extension' => $domain[1]);

  $api      = new OP_API ('https://api.openprovider.eu');
  $request  = new OP_Request;

  $request->setCommand($command)
    ->setAuth(array('username' => $username, 'password' => $password, 'hash' => $hash))
    ->setArgs(array_merge(array(
      'domains' => array($domain),
      'domain'  => $domain,
      ),
      $options
     )
    );
  $reply = $api->setDebug(1)->process($request);
  echo "Code: " . $reply->getFaultCode() . "\n";
  echo "Error: " . $reply->getFaultString() . "\n";
  echo "Value: " . print_r($reply->getValue(), true) . "\n";
  echo "\n---------------------------------------\n";

  echo "Finished example script\n\n";

?>

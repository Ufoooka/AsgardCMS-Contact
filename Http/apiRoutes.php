<?php

$router->get('contact/send',   ['uses' => 'ContactController@send', 'as' => 'api.contact.send']);

$router->post('contact/send',   ['uses' => 'ContactController@send', 'as' => 'api.contact.send']);


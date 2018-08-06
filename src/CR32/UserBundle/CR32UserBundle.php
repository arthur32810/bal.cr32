<?php

namespace CR32\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CR32UserBundle extends Bundle
{
	public function getParent()
	{
		return 'FOSUserBundle';
	}
}

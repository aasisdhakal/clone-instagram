<?php

if (!function_exists('getPerPage')) {
	function getPerPage()
	{
		return request('limit', 15) > 0 ? request('limit', 15) : 3458764513820540928;
	}
}
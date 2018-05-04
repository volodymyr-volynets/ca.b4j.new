<?php

namespace Numbers\Users\Documents\Base\Interface2;
interface Base {
	public function upload(array $file, array $catalog) : array;
	public function download(array $file, array $options = []);
	public function delete(array $file) : array;
}
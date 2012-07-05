# Usage
* Include thumb.lib.php
* Request Thumb::Create function:

```
Thumb::Create(
	$path = "/mnt/home/deviavir/domains/github.com/image.png",
	$type = 'smart', // Resize, Crop, Smart(resize), Rotate
	$width = '200',
	$height = '100',
);
```

This will generate a $path . '.thumb.png' file and return the updated path.

The smart library is based on ThumbXGen for the backend, the frontend class is just to make things easier.
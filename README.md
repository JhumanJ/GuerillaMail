# GuerillaMail
A Laravel wrapper for the GuerillaMail API.

Strongly inspired from this [python wrapper](https://github.com/ncjones/python-guerrillamail/) by **ncjones**.

## Guide

The `GuerillaMail` facade has the following methods: `getEmailAddress`, `getEmailList`, `getEmail`, `setEmailAddress`. For more details, have a look at the `GuerillaMailClient` class.

The methods `getEmailList` and `getEmail` return instances of the `Mail` class which has the following proporties:
- `$from`
- `$timestamp`
- `$date`
- `$replyTo`
- `$read`
- `$subject`
- `$excerpt`
- `$body`
- `$contentType`
- `$id`
- `$recipient`
- `$size`



# Moodle Automatic Restore Tool
Admin tool for automated restore moodle backups.

Tool for automatic and massive restorations in a Moodle installation. Developed as a complement to the automatic generation of backups.
It can be configured and adapted to individual needs, as is typically set when restoring Moodle backup.

It can be configured to run by cron (task), or you can run through your client environment (cli).

Designed for large backup restorations where the number or weight of stored files is very high. It has been tested with over 4GB backups, where files weight was higher than 2.5GB.

It's a contribution of Center of Information Technologies at the University of Balearic Islands.

# Install
The installation process is a typical in Moodle. As a management tool:
* Download the file <moodle_path>/admin/tool/
* Unzip the file.
* Delete the .zip file.
* Login with user which have a administrator privileges and you click in notifications link.

# How to use
Its use is simple:
* In the Moodledata creates a directory for the backups. Copies the backups to be restored there.
* In the Moodledata creates a directory for the process, once it has been restored successfully, the tool copy the backups restored there. For example 'restored' folder.
* Login into Moodle, and goes to the autorestore configuration section. Specify what you want preferences.
* If it executed by task, just wait for it to run.
* If you run for cli, goes to the environment and run it. (php admin/tool/autorestore/cli/autorestore_backups.php)

Enjoy it!
# Welcome to telve.net!

Here you can browse and submit links to content on the Internet or post your own originals. Other people can vote on the links or text you post, highlighting the links will be placed on the home page. You can also comment on the links or text you post and reply to other reviewers.

Each individual topics (URLs starts with `/t` like `/t/NEWS`) has its own concepts, formats, restrictions etc. and when you do not comply with these rules while posting your content to the topic, your content can be deleted or be hidden if somebody report it.

Popular topics are always listed at the top of the site. By clicking **MORE>** you get the page where you can edit your subscriptions. Subscriptions will affect the rankings under **hot** tab. Sidebar at your left will provide you a quick access to your subscriptions.

**new** tab will give you the latest posts.

**controversial** tab will give you the posts which gets most comments.

**top** tab will give you the posts which gets most upvotes.

**rising** tab is some sort of combination of these three.

**hot** tab is the combination of these four plus your subscriptions.

When you submit a new link [telve.net](http://telve.net) automatically detects the best image from the given URL. It means you do not interfere with this job.

So what do you waiting for? **[Share a link now](http://telve.net/submit)** with thousands of community members.

### Notes for Developers

Requires a LAMP stack with PHP version 7.0.8 (Ubuntu 16.04) and it's using CodeIgniter version 3.1.2 web framework.

Don't forget to replace database credentials under `application/config/database.php` and import the SQL dump located under `db/` directory.

This project was developed fully in English language until commit number `300d6848610a7cf42eea5c81838a16d291d1eaea` (129. commit). Later on it translated to Turkish language (language of target client) rather than being multilingual because the complexity of handling the support for multiple languages was huge. If you are a global visitor/cloner, I suggest you to revert back to commit number `300d6848610a7cf42eea5c81838a16d291d1eaea` or contact me mert.yildiran@bil.omu.edu.tr for my help to translate it back to English language.

### Requirements

* [Vesta CP](https://vestacp.com/#install)
* Install PHP BC Math library: `sudo apt-get install php-bcmath`

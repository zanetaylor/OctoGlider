OctoGlider
======

**A minimal, responsive, text-focused theme for Octopress, inspired by [Glider](https://github.com/tomcreighton/Glider).**

OctoGlider is a very simple Octopress theme that uses the jQuery $.load() function to inject single posts into the DOM with no page refreshes.

When a post is loaded, the post-slug is added to the URL as a hash. The theme checks to see if a hash is present when URLs are loaded, if so, it loads the correct/requested post via normal permalink resolution.
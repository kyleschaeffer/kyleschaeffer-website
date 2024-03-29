---
id: 816
title: SharePoint 2010 Item Styles and DDWRT
date: 2011-04-12T14:49:53+00:00
author: Kyle
layout: post
guid: https://kyleschaeffer.com/?p=816
permalink: /sharepoint-2010-item-styles-and-ddwrt
redirect_from:
  - /sharepoint/sharepoint-2010-item-styles-and-ddwrt/
categories:
  - SharePoint
---
I’ve done some crazy things to make SharePoint work like I want it to. One of the things that I’ve done in the past is write some insanely complex XSLT functions to format dates in SharePoint 2007 item styles. SharePoint 2007 offered a very useful [`FormatDate` feature](http://www.novolocus.com/2010/04/12/date-formats-in-xsl-with-ddwrt/) of the DDWRT XSL library, but the formatting customization was limited to picking a prefab format, which didn’t always gel with what you or your client wanted to see. To get some custom date formats, I wrote crazy XSLT functions that literally had

`<xsl:if>` statements that checked a substring of the SharePoint date for every month of the year (seriously). Not the ideal solution, but it worked; sometimes, SharePoint gives you lemons and you have to make&hellip;well, you know.

## 2010, How Refreshing!

I didn’t realize it at first (mostly because Microsoft documentation on this stuff can be very hard to find), but SharePoint 2010 seems to support a new DDWRT function that I’ve found to be very useful. You can still use `FormatDate`, but you now have a new function called `FormatDateTime` at your designer’s disposal. Here’s how it works.

* Open the file that contains all the item styles for your SharePoint 2010 site (**/Style Library/XSL Style Sheets/ItemStyle.xsl**).
* Near the top of this file, you should see an element called `<xsl:stylesheet>`. Add a new attribute to this element (if it’s not already there) like so:

{% highlight xml %}
xmlns:ddwrt="http://schemas.microsoft.com/WebParts/v2/DataView/runtime"
{% endhighlight %}

* Now, in an item style, you can use the new function like so:

{% highlight xml %}
<xsl:value-of select="ddwrt:FormatDateTime(@Created, 1033, 'MMMM d, yyyy')" />
{% endhighlight %}

Simply substitute `@Created` for the date/time column of your choice. You can use a lot of different values for the date (in our example above, the date is output in `MMMM d, yyyy` format, which appears like **April 12, 2011** within an item style. Refer to [Microsoft’s MSDN article](http://msdn.microsoft.com/en-us/library/8kb3ddd4(v=vs.95).aspx) for a list of all the date variations that you can use – it’s highly flexible, and allows you to output things like 12-hour time formats or even time zone information (something that was lacking in the old `FormatDate` function).

## More Item Style Resources

While we’re on the topic of SharePoint 2010 item styles, I’ve run into a few snags in this new product, and you might just benefit from my experience while you’re rolling your own custom item styles. Most importantly, you might notice that after creating a new custom item style and applying it to a page, it works splendidly _until_ you open that page up and view it as an anonymous user. Everything is checked in, published, and soon you’ll be pulling your hair out trying to figure out why anonymous users are getting a mysterious error message on your fancy new item styles.

You can fix this strange anonymous-users-only error in one of two ways:

  1. Some item styles start out with XSL variables that have names like `SafeImageUrl` or `DisplayTitle`. If you aren’t using these variables in your item style, simply delete these variables altogether! The presence of these variables can _sometimes_ cause the anonymous error message to appear, and removing them is often all that is needed to resolve your issues.
  2. Waldek Mastykarz found that adding `DocumentIconImageUrl` and `OnClickForWebRendering` to the `CommonViewFields` property of the web part also clears up any issues you might have with this error appearing for anonymous users. You can [read Waldek’s post here](http://blog.mastykarz.nl/inconvenient-sharepoint-2010-content-query-web-part-anonymous-access/) for more information. Basically, you need to _export_ the web part, open it up in a text editor, and find the line that says `CommonViewFields`, and change this line to what you see in Waldek’s post. Once that’s done, simply import the web part back into the page (delete the old one), and you should be all set.

As always, if you’re looking to get started creating item styles in SharePoint 2010, [Heather Solomon’s custom item styles blog post](http://www.heathersolomon.com/blog/articles/CustomItemStyle.aspx) is still relevant to everything you’ll need to do in SharePoint 2010.

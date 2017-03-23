

.. ==================================================
.. FOR YOUR INFORMATION
.. --------------------------------------------------
.. -*- coding: utf-8 -*- with BOM.

.. ==================================================
.. DEFINE SOME TEXTROLES
.. --------------------------------------------------
.. role::   underline
.. role::   typoscript(code)
.. role::   ts(typoscript)
   :class:  typoscript
.. role::   php(code)


Configuration
-------------

As explained in the introduction, this extension allows you to do
redirects via TypoScript, so all configuration is done in TypoScript.

When called, the script will compare current URL with all his
parameters to the target, if target is different then it's redirect to
this page, this prevent a direct infinite loop.

**You should always be careful not to create an infinite redirection between
two pages that redirect one to the other..**


.. toctree::
   :maxdepth: 5
   :titlesonly:
   :glob:

   Reference/Index




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


Reference
^^^^^^^^^

Possible subsections: Reference of TypoScript options.

.. ### BEGIN~OF~TABLE ###


.. container:: table-row

   Property
         if

   Data type
         `->if <http://docs.typo3.org/typo3cms/TyposcriptReference/Functions/If
         /Index.html#if>`_

   Description
         If the if-object returns false, no redirection is done.



.. container:: table-row

   Property
         typolink

   Data type
         `->typolink <http://docs.typo3.org/typo3cms/TyposcriptReference/Functi
         ons/Typolink/Index.html#typolink>`_

   Description
         Create the target URL via a typolink.

         “returnLast = url” and “forceAbsolutePath = 1” are forced

         **Note:** All parameters used to create the link-tag are ignored
         because of “returnLast = url”

         **Example:**

         ::

            page.5 = USER
            page.5{
              userFunc = CDSRC\CdsrcTsredirect\Service\RedirectionService->redirect
              typolink{
                parameter = 54
              }
            }


.. container:: table-row

   Property
         status

   Data type
         integer / stdWrap

   Description
         Set the header status code.

         Only status from 300 to 399 based on `RFC2616
         <http://tools.ietf.org/html/rfc2616>`_

         **.message** (string / stdWrap):

         Allow to set an other message to the header redirection.

         **Example:**

         ::

            page.5{
              userFunc = user_cdsrctsredirect->redirect
              typolink …
              status = 301
              status.message = Moved Permanently
              status.message.lang.fr = Déplacement définitif
            }

   Default
         302


.. ###### END~OF~TABLE ######


Example 1
"""""""""

This example will simply redirect to the root page:

::

   page.5 = USER
   page.5{
     userFunc = CDSRC\CdsrcTsredirect\Service\RedirectionService->redirect
     typolink{
       parameter.data = leveluid:-1
     }
   }


Example 2
"""""""""

This example will logout user if his uid is “2” to :

::

   page.5 = USER
   page.5{
     userFunc = CDSRC\CdsrcTsredirect\Service\RedirectionService->redirect
     if{
       value = 2
       equals.data = tsfe:fe_users|user|uid
                 }
     typolink{
       parameter.data = tsfe:id
       parameter.additionalParams = &logintype=logout
     }
   }


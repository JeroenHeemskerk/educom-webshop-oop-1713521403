```mermaid
---
title: Class Inheritance Diagram - Webshop
---
classDiagram
    note "+ = public, - = private, # = protected"
    %% A <|-- B means that class B inherits from class A %%
    HtmlDoc <|-- BasicDoc

    BasicDoc <|-- HomeDoc
    BasicDoc <|-- AboutDoc
    BasicDoc <|-- Error404Doc
    BasicDoc <|-- FormDoc
    BasicDoc <|-- ProductDoc

    FormDoc <|-- ContactDoc
    FormDoc <|-- LoginDoc
    FormDoc <|-- RegisterDoc
    FormDoc <|-- AccountDoc

    ProductDoc <|-- ShopDoc
    ProductDoc <|-- CartDoc
    ProductDoc <|-- DetailDoc
    ProductDoc <|-- Top5Doc
    

    class HtmlDoc{
        <<abstract>>
       +show()
       -showHtmlStart()
       -showHeaderStart()
       #showHeaderContent()
       -showHeaderEnd()
       -showBodyStart()
       #showBodyContent()
       -showBodyEnd()
       -showHtmlEnd()
    }
    class BasicDoc{
        #data 
        +__construct(mydata)
        #showHeaderContent()
        -showTitle()
        -showCssLinks()
        #showBodyContent()
        #showHeader()
        -showMenu()
        -showGeneralError()
        #showContent()
        -showFooter()
    }
    class HomeDoc{
        #showHeader()
        #showContent()
    }
    class AboutDoc{
        #showHeader()
        #showContent()
    }
    class Error404Doc{
        #showHeader()
        #showContent()
    }
    class FormDoc{
        <<abstract>>
        #showFormStart()
        #showFormField()
        #showFormEnd()
        #showError()
    }
    class ContactDoc{
        #showHeader()
        #showContent()
    }
    class LoginDoc{
        #showHeader()
        #showContent()
    }
    class RegisterDoc{
        #showHeader()
        #showContent()
    }
    class AccountDoc {
        #showHeader()
        #showContent()
    }
    class ProductDoc{
        <<abstract>>
        #showActionButton() 
    }
    class ShopDoc{
        #showHeader()
        #showContent()
    }
    class DetailDoc{
        #showHeader()
        #showContent()
    }
    class CartDoc{
        #showHeader()
        #showContent()
    }
    class Top5Doc{
        #showHeader()
        #showContent()
    }


```

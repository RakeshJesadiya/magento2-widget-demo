# magento2-widget-demo
Custom CMS Page widget demo

    1. Create a new widget definition, it should have such options:
        1.1. Title - text input field, value not required
        1.2. Display mode - select input field with options, the value required
        1.3. All pages - will show a list of all CMS pages in the current store view
        1.4. Specific pages - only selected pages will be displayed in the current view (triggers 'Selected pages' field to be displayed)
        1.5. Selected pages - a multi-select field with all the CMS pages as options, hidden by default (depends on 'Display mode - Specific pages')
    2. Create a PHP class instance for the widget, that will contain:
        2.1. Widget options and values as constants
        2.2. Functionality to retrieve widget titles and all/or selected CMS pages
    3. Create a new template to display the widget title and list of CMS pages


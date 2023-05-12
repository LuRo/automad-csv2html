# Automad CSV to HTML table extension

This extension extends automad to generate tables from simple csv file strings.

## Options

| Param | Description | Values |
|----|---|---|
| rawText | submit csv (separator is semicolumn) formated raw text | use '#' as line break |
| hasHeader | first row shall be formated as header row | true\|false |
| cssTableClass | none or multiple css classes. the generic 'table' class must not be set, it is added automatically | string |
| cssTheadClass | none or multiple css classes. | string |

## Usage

call the formatter from within your template:
<@ LuRo/Csv2Html { rawText: rawText: @{ yourVariableCsvTextName }, hasHeader: @{ yourVariableHasHeaderName | def ('true') } } @>

## Example Data

Header cell 1;Header cell 2;Header cell 3#
Row1 celldata1;Row1 celldata2;Row1 celldata3#

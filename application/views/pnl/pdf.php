<!DOCTYPE html>
<html lang="en">
<head>
    <title>Generated P&L</title>
</head>
<body>
    <table class="table" width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td colspan="7" class="darkblue-background" style="text-align:left;color: white;text-transform: uppercase;"><?php echo 'Company (' . $company_name . ')' ?></td>
            <td colspan="7" class="darkblue-background" style="text-align:right;color: white;">&nbsp;</td>
		</tr>
        <tr>
            <td colspan="7" class="darkblue-background" style="text-align:left;color: white;">Profit and Loss(P&l) Statement</td>
            <td colspan="7" class="darkblue-background" style="text-align:left;color: white;">&nbsp;</td>
		</tr>
        <tr>
            <td colspan="7" class="darkblue-background" style="text-align:left;color: white;">&nbsp;</td>
            <td colspan="7" class="darkblue-background" style="text-align:left;color: white;">&nbsp;</td>
		</tr>
        <tr>
            <td colspan="8" class="darkblue-background" style="color: white;">&nbsp;</td>
            <td colspan="2" class="darkblue-background" style="color: white;font-weight: bold;">2019</td>
            <td colspan="2" class="darkblue-background" style="color: white;font-weight: bold;">2020</td>
            <td colspan="2" class="darkblue-background" style="color: white;font-weight: bold;">2021</td>
        </tr>
        <!-- data -->
      <?php foreach ($profits as $profit) { 
            $year_1_profit += !isset($profit->ledger_balance[0])? 0 : $profit->ledger_balance[0];
            $year_2_profit += !isset($profit->ledger_balance[1])? 0 : $profit->ledger_balance[1];
            $year_3_profit += !isset($profit->ledger_balance[2])? 0 : $profit->ledger_balance[2];

            $year_1_tax += !isset($profit->ledger_tax_balance[0])? 0 : $profit->ledger_tax_balance[0];
            $year_2_tax += !isset($profit->ledger_tax_balance[1])? 0 : $profit->ledger_tax_balance[1];
            $year_3_tax += !isset($profit->ledger_tax_balance[2])? 0 : $profit->ledger_tax_balance[2];
          ?>
        <tr>
            <td class="dhead" colspan="8"><?php echo $profit->group_title ?></td>
            <td colspan="2"><?php echo number_format(!isset($profit->ledger_balance[0])? 0 : $profit->ledger_balance[0],2)  ?></td>
            <td colspan="2"><?php echo number_format(!isset($profit->ledger_balance[1])? 0 : $profit->ledger_balance[1],2) ?></td>
            <td colspan="2"><?php echo number_format(!isset($profit->ledger_balance[2])? 0 : $profit->ledger_balance[2],2) ?></td>
        </tr>
      <?php } ?>
        <tr>
            <th class="dhead" colspan="8">Total Net Revenue</th>
            <th colspan="2"><?php echo number_format(!isset($year_1_profit)? 0 : $year_1_profit,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_2_profit)? 0 : $year_2_profit,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_3_profit)? 0 : $year_3_profit,2)  ?></th>
        </tr>

        <tr>
            <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
            <td class="dhead" colspan="8">Cost of Goods Sold</td>
            <td colspan="2"><?php echo number_format(!isset($assets[0])? 0 : $assets[0],2) ?></td>
            <td colspan="2"><?php echo number_format(!isset($assets[1])? 0 : $assets[1],2) ?></td>
            <td colspan="2"><?php echo number_format(!isset($assets[2])? 0 : $assets[2],2) ?></td>
        </tr>
        <tr>
           <?php $gross_profit_year_1 = $year_1_profit - $assets[0]?>
           <?php $gross_profit_year_2 = $year_2_profit - $assets[1]?>
           <?php $gross_profit_year_3 = $year_3_profit - $assets[2]?>
            <th class="dhead" colspan="8">Gross Profit</th>
            <th colspan="2"><?php echo number_format($gross_profit_year_1,2) ?></th>
            <th colspan="2"><?php echo number_format($gross_profit_year_2,2) ?></th>
            <th colspan="2"><?php echo number_format($gross_profit_year_3,2) ?></th>
        </tr>

        <tr>
            <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="14" style="text-align:left;font-weight: bold;">Expenses</td>
		</tr>

        <?php foreach ($expenses as $expense) {
            $year_1_expense += !isset($expense->ledger_balance[0])? 0 : $expense->ledger_balance[0];
            $year_2_expense += !isset($expense->ledger_balance[1])? 0 : $expense->ledger_balance[1];
            $year_3_expense += !isset($expense->ledger_balance[2])? 0 : $expense->ledger_balance[2];
        ?>
        <tr>
            <td class="dhead" colspan="8"><?php echo $expense->group_title ?></td>
            <td colspan="2"><?php echo number_format(!isset($expense->ledger_balance[0])? 0 : $expense->ledger_balance[0],2)  ?></td>
            <td colspan="2"><?php echo number_format(!isset($expense->ledger_balance[1])? 0 : $expense->ledger_balance[1],2)  ?></td>
            <td colspan="2"><?php echo number_format(!isset($expense->ledger_balance[2])? 0 : $expense->ledger_balance[2],2)  ?></td>
        </tr>
        <?php } ?>

        <tr>
            <th class="dhead" colspan="8">Total Expenses</th>
            <th colspan="2"><?php echo number_format(!isset($year_1_expense)? 0 : $year_1_expense,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_2_expense)? 0 : $year_2_expense,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_3_expense)? 0 : $year_3_expense,2)  ?></th>
        </tr>
        <tr>
            <th class="dhead" colspan="8">Taxes</th>
            <th colspan="2"><?php echo number_format(!isset($year_1_tax)? 0 : $year_1_tax,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_2_tax)? 0 : $year_2_tax,2)  ?></th>
            <th colspan="2"><?php echo number_format(!isset($year_3_tax)? 0 : $year_3_tax,2)  ?></th>
        </tr>
        <tr>
        <?php $profit_without_tax_year_1 = $gross_profit_year_1 - $year_1_expense - $year_1_tax?>
        <?php $profit_without_tax_year_2 = $gross_profit_year_2 - $year_2_expense - $year_2_tax?>
        <?php $profit_without_tax_year_3 = $gross_profit_year_3 - $year_3_expense - $year_3_tax?>
            <th class="dhead" colspan="8">Earnings Before Interest & Taxes</th>
            <th colspan="2"><?php echo number_format($profit_without_tax_year_1,2) ?></th>
            <th colspan="2"><?php echo number_format($profit_without_tax_year_2,2) ?></th>
            <th colspan="2"><?php echo number_format($profit_without_tax_year_3,2) ?></th>
        </tr>
    </table>
</body>
</html>
<style>
    .table{
        text-align: center;
    }
    table td{
        padding: 5px;
    }
    table th{
        padding: 5px;
        border-top: 1px solid black;
    }
    .dhead {
        text-align: left;
    }
    .darkblue-background{
        background-color: #002160;
    }
</style>

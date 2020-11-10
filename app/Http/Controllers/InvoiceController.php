<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;
use App\Models\Invoices;
use App\Models\InvoiceLines;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoices::all();

        return view('invoices.index', compact('invoices'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoices::find($id);

        $seller = new Party([
            'name'          => $invoice->seller->name,
            'phone'         => $invoice->seller->phone,
            'custom_fields' => [
                'code' => $invoice->seller->code,
            ],
        ]);

        $buyer = new Party([
            'name'          => $invoice->buyer->name,
            'phone'         => $invoice->buyer->phone,
            'custom_fields' => [
                'code' => $invoice->buyer->code,
            ],
        ]);

        foreach ($invoice->lines as $line) {
            $items[] = (new InvoiceItem())->title($line->unit_name)->pricePerUnit($line->unit_price)->quantity($line->quantity)->discount($line->discount);
        }

        $notes = [
            $invoice->notes
        ];
        $notes = implode("<br>", $notes);

        $generatedInvoice = Invoice::make('receipt')
            ->series($invoice->series)
            ->sequence($invoice->sequence)
            ->serialNumberFormat('{SEQUENCE}/{SERIES}')
            ->seller($seller)
            ->buyer($buyer)
            ->date(now()->subWeeks(3))
            ->dateFormat('m/d/Y')
            ->payUntilDays($invoice->until_days)
            ->currencySymbol($invoice->currency_symbol)
            ->currencyCode($invoice->currency_code)
            ->currencyFormat('{SYMBOL}{VALUE}')
            ->currencyThousandsSeparator('.')
            ->currencyDecimalPoint(',')
            ->filename($invoice->seller->name . ' ' . $invoice->buyer->name)
            ->addItems($items)
            ->notes($notes)
            ->template()
            ->save('public');

        return $generatedInvoice->stream();

    }
}

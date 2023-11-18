<?php
class DownloadNotes
{
    public static function Download($content)
    {

        require_once('TCPDF/tcpdf.php');

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
            require_once(dirname(__FILE__) . '/lang/eng.php');
            $pdf->setLanguageArray($l);
        }

        $pdf->SetFont('helvetica', '', 9);
        $pdf->AddPage();
        $pdf->writeHTML($content, true, 0, true, 0);
        $pdf->lastPage();

        // Output the PDF as a download
        $pdf->Output('table.pdf', 'D');
    }
}

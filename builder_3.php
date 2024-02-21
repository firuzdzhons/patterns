<?php

interface ReportBuilder 
{
    public function addHeader(): void;

    public function addBody(): void;

    public function addFooter(): void;
}

class PDFReportBuilder implements ReportBuilder
{
    private $report;

    public function __construct()
    {
        $this->reset();
    }
    public function reset(): void
    {
        $this->report = new Report();
    } 

    public function addHeader(): void
    {
        $this->report->parts[] = 'PDF Header';
    }

    public function addBody(): void
    {
        $this->report->parts[] = 'PDF Body';
    }

    public function addFooter(): void
    {
        $this->report->parts[] = 'Add footer';
    }

    public function getReport(): Report
    {
        $result = $this->report;
        $this->reset();

        return $result;
    }
}

class HTMLReportBuilder implements ReportBuilder
{
    private $report;

    public function __construct()
    {
        $this->reset();
    }
    public function reset(): void
    {
        $this->report = new Report();
    } 

    public function addHeader(): void
    {
        $this->report->parts[] = 'HTML Header';
    }

    public function addBody(): void
    {
        $this->report->parts[] = 'HTML Body';
    }

    public function addFooter(): void
    {
        $this->report->parts[] = 'HTML footer';
    }

    public function getReport(): Report
    {
        $result = $this->report;
        $this->reset();

        return $result;
    }
}

class  Report
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Report parts: " . implode(', ', $this->parts)."\n\n";
    }
}

class Director
{
    /**
     * @var ReportBuilder
     */
    private $builder;


    public function setBuilder(ReportBuilder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMiniReport(): void
    {
        $this->builder->addBody();
    }

    public function buildFullReport(): void
    {
        $this->builder->addHeader();
        $this->builder->addBody();
        $this->builder->addFooter();
    }
}


function clientCode(Director $director)
{
    $builder = new PDFReportBuilder();
    $director->setBuilder($builder);

    echo "Standard basic report:\n";
    $director->buildMiniReport();
    $builder->getReport()->listParts();

    echo "Standard full featured report: \n";
    $director->buildFullReport();
    $builder->getReport()->listParts();
}

$director = new Director();
clientCode($director);
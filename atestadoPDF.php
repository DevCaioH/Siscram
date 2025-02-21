<?php
require_once('tcpdf/tcpdf.php');
require('conexaobd.php');


$nome = $_POST['nome'];
$endereco = $_POST['ende'];
$data = $_POST['data_atual'];
$CID = $_POST['cid'];
$motivo = $_POST['motivo'];
$opcao = $_POST['opcao'];
$horarioChegada = $_POST['horario_chegada'];
$horarioSaida = $_POST['horario_saida'];
$quantidadeDias = $_POST['quantidade_dias'];
$periodo = $_POST['periodo'];

$enderecoFK = $endereco;

if ($endereco == 1){
    $endereco = "R. Antônio Nelson Barbosa, 86 - Jardim do Bosque, Hortolândia - SP, 13186-231. Telefone: (19)3819-8441";
    $cidade = "Hortolândia";
}elseif($endereco == 2){
    $endereco = "Av. São Francisco de Assis, 289 - Vila Real, Hortolândia - SP, 13183-090. Telefone: (19) 3897-2011 ";
    $cidade = "Hortolândia";
}elseif($endereco == 3){
    $endereco = "Av. Barão de Itapura, 610 - Botafogo, Campinas - SP, 13020-430";
    $cidade = "Campinas";
}

if ($motivo == '1'){
    $motivo = "para realização de uma consulta médica";
} elseif($motivo == '2'){
    $motivo = "para realização de um exame";
}else{
    $motivo = "para acompanhar Paciente";
}

if ($opcao == 'dia') {
    $opcao = ". O mesmo deverá permanecer de repouso durante o período de $quantidadeDias Dia(s)";

} elseif ($opcao == 'horas'){

    $opcao = ", no período das $horarioChegada às $horarioSaida";

} elseif ($opcao == 'meio_periodo'){
    $opcao = ". O mesmo deverá permanecer de repouso no período da $periodo";
}

$sqldados = "INSERT INTO atestado (Endereco_consultorio , data_Consulta, CID , desc_atestado, motivo, nome_Paciente) VALUES ('$enderecoFK','$data', '$CID', '$opcao', '$motivo', '$nome')";

mysqli_query($con , $sqldados) or die("<script>alert('Não foi possível salvar. Por favor, tente novamente mais tarde.');</script>");


// Classe personalizada para gerar o PDF
class PDF extends TCPDF {
    // Variáveis para armazenar o cabeçalho e o rodapé
    private $headerText;
    private $footerText;

    // Função para definir o cabeçalho
    public function setHeaderText($text) {
        $this->headerText = $text;
    }

    // Função para definir o rodapé
    public function setFooterText($text) {
        $this->footerText = $text;
    }

    // Função para criar o cabeçalho
    public function Header() {
        // Define o cabeçalho como HTML justificado
        $this->writeHTML($this->headerText, true, false, false, false, 'C');
    }

    public function addLogo($imagePath, $x, $y, $width = '', $height = '') {
        $this->Image($imagePath, $x, $y, $width, $height);
    }

    // Função para criar o rodapé
    public function Footer() {
        // Centraliza o rodapé
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 0, $this->footerText, 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

 
}


// Cria uma nova instância do TCPDF
$pdf = new PDF('P', 'mm', 'A4', true, 'UTF-8', false);

// Define o cabeçalho e o rodapé
$headerText = '<div style="text-align: center;">
                    <strong><em>DR. JOSÉ ROBERTO RIBEIRO</em></strong><br>
                    Ortopedia<br>
                    Medicina do trabalho<br>
                    Medicina do Tráfego<br>
                    Perícia Médica<br>
                    CREMESP 26599
               </div>';


$conteudo = "<div style='text-align: center;'>
                Atesto para os devidos fins, que o Sr.(a) <strong><em>$nome</em></strong>, esteve sob cuidados médicos razão do CID $CID </em></strong>$motivo</em></strong> no dia $data<strong><em>$opcao</em></strong>.
            </div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div><br></div>
            <div style='text-align:center'>
            $cidade-SP, $data.
            </div>
            <div><br></div>
            <div><br></div>
            <div style='text-align:center'>
            _________________________
            </div>
            <div style='text-align:center'>
            <strong><em>DR. JOSÉ ROBERTO RIBEIRO</em></strong>
            <br>
            CREMESP 26599
            </div>";


$pdf->setFooterText($endereco);

// Adiciona uma nova página
$pdf->AddPage();

// Define a fonte e o tamanho do conteúdo
$pdf->SetFont('helvetica', '', 12);

// Calcula a largura e a altura necessárias para o conteúdo
$contentWidth = $pdf->GetPageWidth() - $pdf->GetX() * 2;
$contentHeight = $pdf->getStringHeight($contentWidth, $conteudo);

// Calcula a posição vertical do conteúdo
$contentY = $pdf->GetY() + 70; // Adicione um espaço de 50mm (dois dedos) abaixo do cabeçalho

// Verifica se há espaço suficiente para o conteúdo na página atual
if ($contentY + $contentHeight > $pdf->GetPageHeight() - 15) {
    // Não há espaço suficiente, adiciona uma nova página
    $pdf->AddPage();
    $contentY = $pdf->GetY() + 70; // Atualiza a posição vertical do conteúdo
}

// Exibe o cabeçalho
$pdf->writeHTML($headerText, true, false, false, false, 'C');

// Exibe o conteúdo formatado
$pdf->writeHTMLCell($contentWidth, $contentHeight, $pdf->GetX(), $contentY, $conteudo, 0, 1, false, true, 'J', true);

// Adiciona bordas ao redor de toda a página
$pdf->Rect(5, 5, $pdf->GetPageWidth() - 10, $pdf->GetPageHeight() - 10, 'D');

// Adicione o logotipo
$logoPath = 'img/logo_ortopedia.png';
$pdf->addLogo($logoPath, 10, 10, 30, 30); // Ajuste as coordenadas e o tamanho conforme necessário

// Gera o PDF
$pdf->Output('.pdf', 'I');
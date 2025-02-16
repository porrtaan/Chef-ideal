-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 16-Fev-2025 às 21:15
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cozinha`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id_user` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `qtd_cart` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `carrinho`
--

INSERT INTO `carrinho` (`id_user`, `id_prod`, `qtd_cart`) VALUES
(2, 9, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(11) NOT NULL,
  `nome_categoria` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`, `descricao`, `estado`) VALUES
(2, 'Facas', 'Facas de alta qualidade para corte preciso, ideais para chefs e cozinheiros domésticos.', 'A'),
(3, 'Utensilios', 'Espátulas, colheres, batedores e outros utensílios para preparar refeições com praticidade.', 'D'),
(4, 'Assadeiras e Formas', 'Peças indispensáveis para assar bolos, pães e preparar pratos no forno.', 'A'),
(12, 'Frigideiras', 'As frigideiras são utensílios de cozinha essenciais para preparar uma variedade de alimentos. Geralmente feitas de materiais como alumínio, aço inoxidável, ferro fundido ou antiaderentes (como Teflon), elas possuem um formato circular e bordas baixas, o que facilita o manuseio e o cozimento uniforme dos alimentos.', NULL),
(13, 'Tachos', 'Os tachos são utensílios indispensáveis em qualquer cozinha, ideais para preparar uma variedade de pratos, desde sopas e molhos até cozidos e guisados. Feitos com materiais de alta qualidade, como aço inoxidável, alumínio ou cerâmica, os tachos oferecem durabilidade e distribuição uniforme de calor, garantindo que seus alimentos sejam cozidos de maneira perfeita.', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhe_venda`
--

CREATE TABLE `detalhe_venda` (
  `id_detalhe` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `nome_morada` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `outras_info` varchar(255) DEFAULT NULL,
  `pais` varchar(100) NOT NULL,
  `cod_post` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `detalhe_venda`
--

INSERT INTO `detalhe_venda` (`id_detalhe`, `id_venda`, `id_prod`, `quantidade`, `preco_venda`, `nome_morada`, `endereco`, `outras_info`, `pais`, `cod_post`, `cidade`) VALUES
(31, 35, 9, 1, 147.00, 'Casa', 'PC General humberto delgado', 'Apartameto 5 esq', 'Portugal', '2800-108', 'Lisboa'),
(32, 36, 11, 1, 403.00, 'Casa1', 'Rua das flores', 'apartamento 6', 'Portugal', '2800-108', 'Lisboa'),
(33, 37, 10, 1, 128.00, 'Casa', 'PC General humberto delgado', 'Apartameto 5 esq', 'Portugal', '2800-108', 'Lisboa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `id_marca` int(11) NOT NULL,
  `nome_marca` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`id_marca`, `nome_marca`, `descricao`, `estado`) VALUES
(2, 'Wüsthof', 'Marca alemã de facas de alta qualidade e precisão.', 'A'),
(3, 'Zwilling', 'Conhecida por facas de chef e acessórios de cozinha sofisticados.', 'A'),
(4, 'Shun', 'Facas japonesas feitas à mão com design de luxo.', 'A'),
(5, 'Staub', 'Especializada em panelas de ferro fundido de alta performance e estilo.', 'A'),
(6, 'Mauviel', 'Fabricante francesa de utensílios de cobre para cozinha.', 'A'),
(7, 'Rosle', 'Utensílios de cozinha de luxo, como raladores e colheres.', 'A'),
(8, 'Fissler', 'Panelas e acessórios manuais para chefs exigentes.', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `morada`
--

CREATE TABLE `morada` (
  `id_morada` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `morada` varchar(255) DEFAULT NULL,
  `outras_info` varchar(255) DEFAULT NULL,
  `pais` varchar(100) NOT NULL,
  `cod_post` varchar(10) NOT NULL,
  `cidade` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `morada`
--

INSERT INTO `morada` (`id_morada`, `id_user`, `endereco`, `morada`, `outras_info`, `pais`, `cod_post`, `cidade`) VALUES
(21, 4, 'Rua das flores', 'Casa', '', 'Portugal', '2800-108', 'Lisboa'),
(22, 4, 'Rua das flores', 'Casa1', '', 'Portugal', '2800-108', 'Lisboa'),
(25, 4, 'Rua das flores', 'casa 2', 'apartamento 6', 'Portugal', '2800-108', 'Lisboa'),
(26, 2, 'Rua das flores', 'Casa1', 'apartamento 6', 'Portugal', '2800-108', 'Lisboa'),
(28, 5, 'PC General humberto delgado', 'Casa', 'Apartameto 5 esq', 'Portugal', '2800-108', 'Lisboa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_prod` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `preco_uni` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `imagem_principal` varchar(255) NOT NULL,
  `imagem_2` varchar(255) DEFAULT NULL,
  `imagem_3` varchar(255) DEFAULT NULL,
  `data_insert` date DEFAULT current_timestamp(),
  `carrossel` varchar(1) NOT NULL,
  `estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_prod`, `nome`, `descricao`, `preco_uni`, `stock`, `id_marca`, `imagem_principal`, `imagem_2`, `imagem_3`, `data_insert`, `carrossel`, `estado`) VALUES
(9, 'JCK  Natures Blue Clouds', 'ossas facas de marca doméstica \"JCK Natures\" provaram ser algumas das facas mais populares da JCK’. Cada um deles tem uma aparência única, características finas e oferece grande valor para o dinheiro. Nossas Facas Natures JCK são uma fusão das técnicas artísticas especiais do artesão e do magnífico cenário da natureza todo-poderosa.  No início do ano de 2020, essas naturezas JCK ⁇ \"Nuvens Azuis VG-10TsuchimeDamasco\" facas foram finalmente concluídas, e estamos muito animados para apresentar e oferecer esses novos produtos para você.As facas \"Blue Clouds\" têm uma impressionante lâmina polida espelhada com umTsuchime           Textura martelada e total de 33 belas camadas de Damasco. O núcleo da lâmina de Aço Inoxidável de Alto Carbono VG-10 resistente à ferrugem é revestido com muitas camadas da bela Damasco. Calor tratado a HRc. 60-61, a lâmina afiada de bisel duplo tem uma moagem simétrica de 50/50.', 147.00, 49, 4, 'faca1_sembg.webp', 'faca_1_sembg.webp', 'faca1__sembg.webp', '2025-02-10', '', 'A'),
(10, 'JCK Natures Santoku', 'Cada faca tem uma única e bela lâmina Vortex Damasco. Eles apresentam um núcleo de lâmina de aço inoxidável VG-10 afiado e afiado à mão que é revestido em ambos os lados com 33 camadas de níquel-aço inoxidável Damasco (HRc. 60-61. Lâmina chanfrada dupla com moagem simétrica 50/50).\r\n\r\nAs facas apresentam uma construção de ponta cheia, balanças de alças Black Pakka Wood, um suporte de aço inoxidável e rebites/pinos de alça de aço inoxidável.\r\n\r\nSe você está olhando para comprar sua primeira faca japonesa, ou procurando um bela faca de Damasco, a nossa gama de preços moderados de alta qualidade \"Facas Uzushio\" são altamente recomendadas.', 128.00, 48, 4, 'faca2.png', 'faca_2.png', 'faca2_.png', '2025-02-10', '', 'A'),
(11, 'Takeshi Saji R-2 ', 'Depois de testar e avaliar um Aço Ferramenta de Alta Velocidade de Metalurgia em Pó muito respeitável, chamado “R-2” (Fabricado pela Kobelco), ele decidiu produzir uma nova e excitante gama desta faca de cozinha Damasco tradicionalmente forjada a martelo usando este moderno ‘super steel’.\r\n\r\nUma lâmina escura de Damasco R-2, que apresenta um padrão de Damasco nítido e vigoroso. Esta faca equipada com balanças de punho Stag Bone e reforço de aço inoxidável polido e rebites, que combinam com o estilo energético da lâmina de Damasco.\r\n\r\nA lâmina alta e o nariz arredondado /ponta do Santoku tornam-na uma faca versátil que é adequada para cortar carne, peixe ou legumes; Daí o nome it“, que literalmente significa “Three-purpose”. O Santoku é frequentemente recomendado como uma faca de cozinha multifuncional. ', 403.00, 17, 2, 'faca3.png', 'faca_3.png', 'faca3_.png', '2025-02-10', '', 'A'),
(12, 'Takeshi Saji SUMMIT', 'Depois de testar e avaliar um Aço Ferramenta de Alta Velocidade de Metalurgia em Pó muito respeitável, chamado “R-2” (Fabricado pela Kobelco), ele decidiu produzir uma nova e excitante gama desta faca de cozinha Damasco tradicionalmente forjada a martelo usando este moderno ‘super steel’.\r\n\r\nUma lâmina escura de Damasco R-2, que apresenta um padrão de Damasco nítido e vigoroso, o estilo energético da lâmina de Damasco. É feito à mão usando uma série complexa de processos de forjamento e passa por um processo de gravação ácida especialmente formulado.\r\n\r\nUm dia, no US Knife Show, nos encontramos acidentalmente com este material exclusivo da Cor Rosa Escura e da Cor Vermelha do Vinho, o Maplewood Hybrid estabilizado. Pedimos prontamente ao Mestre Saji que usasse esta madeira especial para sua faca de edição muito limitada e agora outra obra-prima da faca Saji SUMMIT- Limited Edition Custom Series está disponível.\r\n\r\nO Unique Custom Handmade Hybrid Wood Handle tem uma aparência bonita e para garantir que ele possa ser agarrado confortavelmente, foi cuidadosamente contornado e polido à mão. Um Pino Mosaico decorativo fixa as balanças das alças e um suporte de aço inoxidável foi montado para melhorar a durabilidade e o equilíbrio da lâmina da faca.\r\n\r\nA lâmina alta e o nariz arredondado /ponta do Santoku tornam-na uma faca versátil que é adequada para cortar carne, peixe ou legumes; Daí o nome it“, que literalmente significa “Three-purpose”. O Santoku é frequentemente recomendado como uma faca de cozinha multifuncional. ', 502.00, 10, 4, 'faca4.png', 'faca_4.png', 'faca4_.png', '2025-02-10', '', 'D'),
(13, 'Gyutoh 20 cm, Pakka Wood', 'Feitos à mão em Seki, Japão, as facas MIYABI 4000FC são fabricadas com os materiais mais preciosos, para um perfil elegante. O núcleo de aço FC61 proporciona um desempenho de corte excecional e é finalizado com uma verdadeira lâmina de katana. Reconhecidos como alguns dos cutelos mais afiados da indústria, os utensílios de corte japoneses MIYABI são feitos para durar a vida toda.', 169.00, 50, 2, 'faca5.png', 'faca_5.png', 'faca5_.png', '2025-02-10', '', 'A'),
(14, 'Faca de chef 20 cm', 'A faca de chef da linha FOUR STAR® irá impressioná-lo com sua precisão. Esta faca versátil pode ser usada para picar ervas ou cortar legumes, carne ou peixe. A faca é popular entre cozinheiros profissionais e amadores em todo o mundo pelo seu design simples. A lâmina tem 16 cm de comprimento e o cabo de plástico sólido e completo tem sido o padrão nas facas de chef ZWILLING por mais de 30 anos. Este é um dos motivos da popularidade da linha de facas FOUR STAR®. A principal característica destas facas é a lâmina FRIODUR® premium que passa por um processo especial de endurecimento com gelo que torna a faca de chef especialmente afiada, resistente à corrosão e flexível. A lâmina é forjada a partir de uma única peça de fórmula especial de aço inoxidável ZWILLING que combina elementos de crómio e carbono de forma ideal. O reforço garante segurança e higiene e é posicionado na extremidade do cabo de plástico para evitar que os dedos deslizem para a lâmina. O cabo é ergonomicamente formado e balanceado para facilitar até mesmo as tarefas mais longas, além de ser antiderrapante e fácil de limpar. Geometria perfeita e materiais premium tornam a faca de chef da ZWILLING uma ferramenta de cozinha ideal.', 89.00, 50, 2, 'faca6.png', 'faca_6.png', 'faca6_.png', '2025-02-10', '', 'A'),
(15, 'Gyutoh 24 cm, Pakka Wood', 'A faca GYUTOH de 24 cm da série MIYABI 6000MCT é muito adequada para cortar e fatiar carne e peixe. A sua ponta aguçada torna-a ideal para múltiplas tarefas, como retirar as espinhas do peixe ou os ossos da carne. O seu cabo não se deforma e é sempre confortável de segurar. A autêntica lâmina japonesa contribui para que a faca mantenha o fio durante muito tempo. O acabamento liso da lâmina proporciona uma pega estável e, como consequência, o uso da faca é muito seguro. O cabo, ligeiramente arqueado, é feito de madeira de pacará. Este design ergonómico e bem equilibrado assegura que se possam realizar com facilidade diferentes técnicas de corte e que seja necessário aplicar menos força para cortar.', 319.00, 10, 2, 'faca7.png', 'faca_7.png', 'faca7_.png', '2025-02-10', '', 'A'),
(16, 'Cocotte redonda de ferro fundido', 'Um clássico da culinária, a cocotte Le Creuset é apreciada por cozinheiros em todo o mundo há quase um século. Ideal para guisados, assados, sopas, cataplanas e outras receitas, com esta icónica cocotte pode preparar refeições inesquecíveis com um sabor ainda mais intenso e de deixar água na boca.', 265.00, 50, 3, 'tacho1(1).png', 'tacho_1.png', 'tacho1_.png', '2025-02-16', '', 'A'),
(17, 'Cocotte coração de ferro fundido com pega coração', 'Criada com amor, esta peça emblemática é o presente perfeito para assinalar o Dia da Mãe, o Dia dos Namorados, um aniversário ou um casamento. Embora a forma de coração seja inovadora e diferente das restantes peças da coleção em ferro fundido, a funcionalidade é a mesma de sempre. A sua construção em ferro fundido aquece de forma uniforme, intensificando os sabores e mantendo a comida quente, enquanto é maravilhosamente apresentada à mesa. Foi especialmente concebida para guisados, assados, sopas, estufados e para fazer bolos em forma de coração. O toque final é dado pela encantadora pega resistente ao calor em forma de coração.', 299.00, 10, 6, 'tacho2.png', 'tacho_2.png', 'image-removebg-preview.png', '2025-02-16', '', 'A'),
(18, 'Caçarola Baixa Pétala de Ferro Fundido', 'Inspirado na Flor de Anemone francesa, o relevo de pétalas realista e delicado na tampa desta caçarola versátil demonstra a nossa excecional mestria. As pegas garantem um manuseamento seguro, enquanto a pega no centro das pétalas não só dá um toque elegante, como também pode ser utilizado no forno até 260 °C.', 329.00, 20, 7, 'tacho3.png', 'tacho_3.png', 'tacgo.png', '2025-02-16', '', 'A'),
(19, 'Sauce Pan Com Tampa, 18/10 Aço Inoxidável', 'Graças a uma tecnologia de soldagem única, o cabo ergonômico e resistente de DEMEYERE’ é extremamente seguro. E porque não há rebites, é extremamente higiênico. O revolucionário tratamento de superfície Silvinox® mantém o acabamento branco prateado de aço inoxidável, facilitando a limpeza e tornando-o mais resistente a impressões digitais, detergentes agressivos e alimentos ácidos fortes.', 279.99, 12, 3, 'tacho4_.png', 'tacho4.png', 'tacho_4.png', '2025-02-16', '', 'A'),
(20, 'Antiaderente, Forno Holandês Cerâmico de Aço Inoxidável', 'Projetado na Alemanha, os utensílios antiaderentes Clad CFX oferecem os mesmos excelentes benefícios de aquecimento uniforme que os utensílios de cozinha de aço inoxidável não revestidos, juntamente com uma liberação fácil incomparável. Cozinhe um ensopado de frutos do mar, cozinhe um pimentão de carne saudável e refogue a panela assada até o máximo de ternura no forno holandês de 6 litros que é ideal para cozinhar em grandes lotes. Desfrute de uma excelente retenção de calor com a tampa perfeita que proporciona um isolamento energeticamente eficiente', 140.00, 12, 3, 'tacho5.png', 'tacho_5.png', 'tacho5_.png', '2025-02-16', '', 'A'),
(21, ' Aço Inoxidável 18/10, Proline Fry Pan', 'Estas fritadeiras de aço inoxidável com uma construção de 7 camadas proporcionam fritura incomparável, escurecimento perfeito e garantem distribuição e retenção de calor excepcionais. Os frypans maiores apresentam uma alça auxiliar conveniente para fácil manobra.', 269.99, 20, 3, 'frigideira(1).png', 'firigideira_1.png', 'frigideira_.png', '2025-02-16', '', 'A'),
(22, 'Fry Pan, Basil', 'A frigideira Staub doura alimentos lindamente, seja peito de frango, batatas ou bacon. O interior mate preto esmaltado confere textura, promovendo um escurecimento excepcional. O ferro fundido oferece uma distribuição de calor constante e uniforme, para que a temperatura da panela não caia enquanto você cozinha. Lados baixos e curvos facilitam a viragem da comida, o que libera utensílios de ferro fundido esmaltados easy.Staub é a escolha dos melhores chefs do mundo. Com durabilidade excepcional, é perfeito para uso diário em cozinhas gourmet e restaurantes de prestígio em todo o mundo. Cada peça transita lindamente da cozinha para a mesa. Construídas para durar uma vida inteira, essas peças de herança podem ser passadas de geração em geração.', 240.00, 50, 3, 'frigideira2.png', 'frigideira_2.png', 'frigideira2_.png', '2025-02-16', '', 'A'),
(23, 'Antiaderente, Fry Pan de alumínio', 'O ZWILLING Madura Plus combina o melhor do design italiano com a engenharia alemã. Faça salmão perfeitamente macio, legumes sauté e bolinhos fritos nesta frigideira de 10 polegadas de tamanho certo.', 69.99, 12, 3, 'frigideira3.png', 'frigideira_3.png', 'frigideira3_.png', '2025-02-16', '', 'A'),
(24, 'SENSUELL', 'O cabo permite um manusear confortável e seguro pois segue os contornos da mão e contém silicone na parte de baixo.\r\n\r\nA base da frigideira é extra espessa, o que permite alourar os alimentos e evitar que a comida pegue.', 59.00, 30, 6, 'frigideira4.png', 'frigideira_4.png', 'frigideira4_.png', '2025-02-16', '', 'A'),
(25, 'HEMKOMST', 'Próprio para todo o tipo de placas, incluindo de indução.\r\n\r\nO revestimento antiaderente em cerâmica sol-gel resistente reduz o risco de a comida se queimar ou colar ao fundo.\r\n\r\nO revestimento antiaderente permite fritar com menos gordura.\r\n\r\nUma camada de alumínio entre as duas camadas de aço inoxidável assegura que o calor é distribuído uniformemente.', 20.00, 50, 7, 'frigideira5.png', 'frigideira_5.png', 'frigideira5_.png', '2025-02-16', '', 'A'),
(26, ' Silicone Skimming ladle', 'Com a nova série de utensílios, a STAUB completa a sua gama de utensílios de cozinha. O design é ergonômico e funcional e ao mesmo tempo bonito, tornando os utensílios uma combinação harmoniosa para outros produtos STAUB na cozinha e na mesa. A concha de desnatação é a ferramenta perfeita para levantar bolinhos ou legumes de uma panela, remover ovos cozidos da água ou tirar batatas fritas de uma fritadeira. Os buracos deixam todo o líquido cair de volta na panela ou panela. Também é adequado para remover a gordura de um caldo ou sopa –, que funciona ainda melhor quando o caldo esfriou e a gordura congelou. Esta é uma maneira fácil de tornar seu estoque caseiro mais saudável e delicioso. A alça é feita de madeira de acácia e longa o suficiente para proteger do líquido quente, enquanto a parte principal da concha de desnatação é feita de silicone fosco preto.Este material de alta qualidade é adequado para todas as superfícies, incluindo acabamentos antiaderentes, e é extremamente durável e resistente ao calor até 220°C.', 18.95, 50, 5, 'utensilio1.png', 'utensilio_1.png', 'utensilio1_.png', '2025-02-16', '', 'A'),
(27, 'Colher de silicone', 'STAUB apresenta sua nova série de ajudantes de cozinha. Feitas de silicone fosco preto e madeira de acácia, os utensílios foram projetados para combinar com os outros itens STAUB em sua cozinha. O material de alta qualidade tem várias vantagens: o silicone é resistente ao calor até 220°C e não deixa arranhões em ferro fundido ou revestimento antiaderente. A alça feita de madeira de acácia não só parece bonita, também é moldada ergonomicamente e tem um buraco para pendurar o armazenamento. Esta colher multifuncional pode ser usada para a maioria das tarefas durante o cozimento, como mover ingredientes de uma fritura, virar batatas assadas, mexer legumes, levantar alimentos de uma panela e servir à mesa. Sua cabeça triangular contém mais comida do que a colher de servir e a forma facilita o uso em uma panela ou prato de cerâmica angular.', 19.00, 50, 5, 'utensilio2.png', 'utensilio_2.png', 'utensilio2_.png', '2025-02-16', '', 'A'),
(28, 'Staub 31 cm Pinças de silicone', 'A nova gama de utensílios da STAUB também inclui pinças feitas de silicone preto fosco de alta qualidade. As pinças são resistentes ao calor até 220°C e adequadas ou utilizadas em superfícies antiaderentes, bem como em todos os nossos recipientes de cozedura em ferro fundido e cerâmica. Podem ser limpos numa máquina de lavar louça. As pinças têm 31 cm de comprimento, deixando uma distância confortável para a comida quente. Eles são ótimos para tarefas tão diversas como transformar alimentos grelhados, servir massas e lançar saladas. O silicone é mais macio e mais flexível do que o aço inoxidável ou outro material frequentemente usado para pinças de cozinha, para que sua comida delicada permaneça em perfeita forma e não grude nas pinças. As pinças têm um buraco na alça para que possam ser armazenadas em um rack de cozinha com ganchos.', 14.20, 50, 5, 'utensilio3.png', 'utensilio_3.png', 'utensilio3_.png', '2025-02-16', '', 'A'),
(29, 'VARDAGEN', 'Uma ferramenta ideal para adicionar sumo de citrinos frescos aos seus pratos.\r\n\r\nTambém pode ser usado para ralar parmesão na massa, noz moscada para o molho béchamel ou gengibre e alho para dar um toque especial a um molho.', 5.99, 50, 7, 'utensilio_4.png', 'utensilio4.png', 'utensilio4_.png', '2025-02-16', '', 'A'),
(30, 'STRANDFLY', 'Esta forma de mola é perfeita para fazer cheesecake, mousse, quiche, pão de ló e até mesmo piza.\r\n\r\nConcebida com um revestimento antiaderente para desenformar facilmente os seus doces e facilitar a limpeza da mola.\r\n\r\nAs laterais amovíveis com mola permitem retirar facilmente os doces da forma para servir.', 8.00, 50, 5, 'assadeira1(3).png', 'assadeira_1(3).png', 'aa.png', '2025-02-16', '', 'A'),
(31, 'Travessa Heritage rectangular em cerâmica de grés', 'Este prato Heritage em cerâmica de grés é um essencial de cozinha. A sua forma retangular dá para todos os tipos de ingredientes, tornando-se muito versátil para tostar, assar, marinar e servir. As pegas recortadas fáceis de segurar permitem movê-lo de modo seguro e sem esforço, ao passo que as paredes altas proporcionam muito espaço para cozinhar.', 70.00, 20, 6, 'assadeira2.png', 'assadeira_2.png', 'assadeira2_.png', '2025-02-16', '', 'A'),
(32, 'Travessa Heritage oval com tampa em cerâmica de grés', 'Esta travessa oval em cerâmica de grés pertence à nossa série Heritage – uma coleção clássica inspirada nos originais da Le Creuset e nos designs franceses elegantes, apresentados pela primeira vez em 1931. Prática e estética, a tampa conserva a humidade no interior do prato. O resultado? Pratos suculentos, repletos de sabor. Pode usá-la para assar, tostar e inclusivamente marinar.', 135.00, 20, 7, 'assadeira3.png', 'assadeira3_.png', 'assadeira_3.png', '2025-02-16', '', 'A'),
(33, 'Travessa Heritage redonda em cerâmica de grés', 'Com o tamanho perfeito e de forma redonda, este prato é ideal para preparar entradas, bolos e sobremesas. Use-o para servir e para acompanhamentos e deixe os seus convidados provarem. É fabricado com argilas especializadas cozidas às temperaturas mais elevadas, para poder ir à máquina de lavar louça, ao forno, ao micro-ondas e ao congelador.', 55.00, 10, 6, 'assadeira4.png', 'assadeira_4.png', 'assadeira4_.png', '2025-02-16', '', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_categoria`
--

CREATE TABLE `produto_categoria` (
  `id_prod` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `produto_categoria`
--

INSERT INTO `produto_categoria` (`id_prod`, `id_categoria`) VALUES
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 13),
(17, 13),
(18, 13),
(19, 13),
(20, 13),
(21, 12),
(22, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 4),
(31, 4),
(32, 4),
(33, 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `utilizador`
--

CREATE TABLE `utilizador` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `nif` varchar(9) NOT NULL,
  `tipo` varchar(1) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `utilizador`
--

INSERT INTO `utilizador` (`id_user`, `nome`, `telefone`, `email`, `pass`, `nif`, `tipo`, `codigo`, `estado`) VALUES
(1, 'João Machado', '969422997', 'adm@gmail.com', '1234', '', 'A', 0, 'A'),
(2, 'Alves', '969422997', 'joao@gmail.com', '4321', '000000000', 'U', 0, 'A'),
(4, 'João Machado', '969422997', 'joaov@gmail.com', '1234', '111111111', 'U', 0, 'A'),
(5, 'João Machado', '969422997', 'melo.joaov@gmail.com', 'lasanha', '333333333', 'U', 469974, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp(),
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id_venda`, `id_user`, `data_venda`, `total`) VALUES
(35, 5, '2025-02-14 19:15:07', 193.11),
(36, 2, '2025-02-14 22:32:38', 507.99),
(37, 5, '2025-02-16 15:28:50', 169.74);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id_user`,`id_prod`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Índices para tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Índices para tabela `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  ADD PRIMARY KEY (`id_detalhe`),
  ADD KEY `id_venda` (`id_venda`),
  ADD KEY `id_prod` (`id_prod`);

--
-- Índices para tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id_marca`),
  ADD UNIQUE KEY `nome_marca` (`nome_marca`);

--
-- Índices para tabela `morada`
--
ALTER TABLE `morada`
  ADD PRIMARY KEY (`id_morada`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_prod`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Índices para tabela `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD PRIMARY KEY (`id_prod`,`id_categoria`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Índices para tabela `utilizador`
--
ALTER TABLE `utilizador`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `nif` (`nif`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_venda`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  MODIFY `id_detalhe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `morada`
--
ALTER TABLE `morada`
  MODIFY `id_morada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `utilizador`
--
ALTER TABLE `utilizador`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizador` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produto` (`id_prod`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `detalhe_venda`
--
ALTER TABLE `detalhe_venda`
  ADD CONSTRAINT `detalhe_venda_ibfk_1` FOREIGN KEY (`id_venda`) REFERENCES `venda` (`id_venda`) ON DELETE CASCADE,
  ADD CONSTRAINT `detalhe_venda_ibfk_2` FOREIGN KEY (`id_prod`) REFERENCES `produto` (`id_prod`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `morada`
--
ALTER TABLE `morada`
  ADD CONSTRAINT `morada_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizador` (`id_user`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `produto_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id_marca`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `produto_categoria`
--
ALTER TABLE `produto_categoria`
  ADD CONSTRAINT `produto_categoria_ibfk_1` FOREIGN KEY (`id_prod`) REFERENCES `produto` (`id_prod`) ON DELETE CASCADE,
  ADD CONSTRAINT `produto_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id_categoria`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilizador` (`id_user`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

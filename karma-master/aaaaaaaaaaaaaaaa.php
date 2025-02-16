<section class="populerproduct bg-white p-0 shop-product">
            <div class="container">
                <div class="row">
                    <?php
                        $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : null;
                        $categoria = isset($_GET['categoria']) && $_GET['categoria'] != "0" ? $_GET['categoria'] : null;
                        $marca = isset($_GET['marca']) && $_GET['marca'] != "0" ? $_GET['marca'] : null;
                        $genero = isset($_GET['genero']) && $_GET['genero'] != "0" ? $_GET['genero'] : null;
                        $ordem = isset($_GET['ordem']) ? $_GET['ordem'] : null;
                        $preco_min = isset($_GET['preco_min']) ? $_GET['preco_min'] : 0;
                        $preco_max = isset($_GET['preco_max']) ? $_GET['preco_max'] : 20000;
                        $sql = "SELECT * FROM produto WHERE 1=1";
                        if ($pesquisa) {
                            $sql .= " AND (nome LIKE '%$pesquisa%' OR descricao LIKE '%$pesquisa%')";
                        }

                        if ($categoria && $categoria != "0") {
                            $sql .= " AND id_prod IN (
                                SELECT id_prod FROM Produto_Categoria WHERE id_categoria = '$categoria'
                            )";
                        }                        

                        if ($marca && $marca != "0") {
                            $sql .= " AND id_marca = '$marca'";
                        }

                        if ($genero && $genero != "0") {
                            $sql .= " AND genero = '$genero'";
                        }

                        $sql .= " AND preco_uni BETWEEN $preco_min AND $preco_max";

                        if ($ordem) {
                            switch ($ordem) {
                                case 'preco_asc':
                                    $sql .= " ORDER BY preco_uni ASC";
                                    break;
                                case 'preco_desc':
                                    $sql .= " ORDER BY preco_uni DESC";
                                    break;
                                case 'popularidade_desc':
                                    $sql .= " ORDER BY popularidade DESC";
                                    break;
                                case 'popularidade_asc':
                                    $sql .= " ORDER BY popularidade ASC";
                                    break;
                                case 'recente_desc':
                                    $sql .= " ORDER BY data_insert DESC";
                                    break;
                                case 'recente_asc':
                                    $sql .= " ORDER BY data_insert ASC";
                                    break;
                            }
                        }
                        $resultado = mysqli_query($cn, $sql);
                        if (mysqli_num_rows($resultado) > 0){
                            while ($produto = mysqli_fetch_array($resultado)) {
                                $nome = $produto['nome'];
                                $preco = $produto['preco_uni'];
                                $preco_antigo = ($produto['carrossel'] == 'S') ? $preco + 50 : 0;
                                $imagem = $produto['imagem_principal'];
                                
                                echo '
                                <div class="col-md-4 col-sm-6">
                                    <div class="product-item">
                                        <div class="product-item-image" >
                                            <a href="detalhe_produto.php?id_prod='.$produto['id_prod'].'"><img src="dashboard/uploads/'.$imagem.'" alt="Product Name" class="img-fluid"></a>
                                            <div class="cart-icon">
                                                <a href="#"><i class="far fa-heart"></i></a>
                                                <a href="#">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16.75" height="16.75"
                                                        viewBox="0 0 16.75 16.75">
                                                        <g id="Your_Bag" data-name="Your Bag" transform="translate(0.75)">
                                                            <g id="Icon" transform="translate(0 1)">
                                                                <ellipse id="Ellipse_2" data-name="Ellipse 2" cx="0.682" cy="0.714"
                                                                    rx="0.682" ry="0.714" transform="translate(4.773 13.571)"
                                                                    fill="none" stroke="#1a2224" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="1.5" />
                                                                <ellipse id="Ellipse_3" data-name="Ellipse 3" cx="0.682" cy="0.714"
                                                                    rx="0.682" ry="0.714" transform="translate(12.273 13.571)"
                                                                    fill="none" stroke="#1a2224" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="1.5" />
                                                                <path id="Path_3" data-name="Path 3"
                                                                    d="M1,1H3.727l1.827,9.564a1.38,1.38,0,0,0,1.364,1.15h6.627a1.38,1.38,0,0,0,1.364-1.15L16,4.571H4.409"
                                                                    transform="translate(-1 -1)" fill="none" stroke="#1a2224"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="1.5" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-item-info">
                                            <a href="product-details.html">'. $nome .'</a>
                                            <span> '. $preco . ' €</span> ' . ($preco_antigo > 0 ? '<del>' . $preco_antigo . ' €</del>' : '') . '
                                        </div>
                                    </div>
                                </div>';
                                }
                        } else {
                            echo '<div class="col-md-12"><h3>Não há produtos disponíveis</h3></div>';
                        }
                        
                    ?>
                </div>
            </div>
        </section>
<script type="text/javascript" src="<?php echo BASE_URL(); ?>js/funcoes.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL(); ?>js/jquery.js"></script>
<div>
    <form method="post" action="../pagamento">
            <table width="100%">
                <tr>
                    <td width="40%">
                        <span>Item</span>
                    </td>
                    <td width="10%">
                        <span>Quantidade</span>
                    </td>
                    <td width="20%">
                        <span>Valor Unitário</span>
                    </td>
                    <td width="30%">
                        <span>Subtotal</span>
                    </td>
                </tr>
                
                <? 
                    foreach ($pedido as $key){
                       
                ?>
                <tr>
                    <td>
                        <img src="<?= base_url() ?>upload/produtos/<?=$key[0]->caminho?>" width="125px" height="80px"/>
                        <span><?=$key[0]->nome?></span>
                    </td>
                    <td>
                        <select id="txtQuantidade<?=$key[0]->idProduto?>" name="txtQuantidade<?=$key[0]->idProduto?>" onchange="calcularSubTotal(<?=$key[0]->idProduto?>)">
                             <?
                                for($i=1; $i<=5; $i++){
                                    if($key["quantidade"] == $i){
                             ?>
                                    <option selected="selected" value="<?=$i?>"><?=$i?></option>
                            <?
                                    }
                                    else{
                            ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                            <?
                                    }
                                }
                            ?>
                         </select>
                    </td>
                    <td>
                        <span>R$</span>
                        <span id="txtPreco<?=$key[0]->idProduto?>"><?=$key[0]->preco?></span>
                    </td>
                    <td>
                        <span>R$</span>
                        <span id="txtSubTotal<?=$key[0]->idProduto?>"></span>
                    </td>
                </tr>
                
                <?
                    }
                ?>
            </table>
            <div>
                <input type="submit" value="Continuar" >
            </div>
        </form>
    </div>
</div>

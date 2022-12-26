<?php
    class HomePage_Class{
        //Miembros de datos
        private $content;
        private $db_handler;
        private $db_result;

        //Constructor
        public function __construct(){
            try{
                $this->db_handler = new PDO("mysql:host=localhost;dbname=CONTENIDO",
                "User", "090722User*");
                //echo "Conexion a $dbname en $host exitosa";
            } catch(PDOException $e){
                //echo "Conexion a $dbname en $host no posible: " . $e->getMessage();
            }
        }

        //Metodos
        public function print_result(){
            $row_count = 0;
            try{
                $this->db_result = $this->db_handler->prepare("select * from ARTICULOS");
                $this->db_result->execute(array());
                
                $row_count = $this->db_handler->prepare("select count(*) as C from ARTICULOS");
                $row_count->execute(array());
                $row_count = $row_count->fetch()["C"];
            } catch(PDOException $e){
                echo "Accion CRUD no posible: $e->getMessage()";
            }
            $this->db_result->setFetchMode(PDO::FETCH_BOTH);

            ?>
                <table>
                    <tr>
                        <th>ID_ARTICULO</th>
                        <th>TITULO</th>
                        <th>AUTOR</th>
                        <th>FECHA_PUB</th>
                        <th>FECHA_EDI</th>
                        <th>CONTENIDO</th>
                        <th>IMG_SRC</th>
                    </tr>
            <?php
            while($row = $this->db_result->fetch()):
                for($i = 0; $i < $row_count; $i++):?>
                <tr>
                    <?php for($i = 0; $i < (count($row)/2); $i++):?>
                        <td><?php echo ((is_null($row[$i]))?"Nulo":htmlspecialchars($row[$i])) ?></td>
                    <?php endfor; ?>
                </tr>
                <?php endfor; ?>
            <?php endwhile; ?>
                </table>
            <?php
        }
    }
?>
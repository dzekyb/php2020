<?php

    /**
     * Class communicating with database
     */

    class DatabaseObject {

        /**
         * get properties from class instance static database fields
         * use the fields as array keys and class instance attributes as values
         *
         * @return array
         */
        protected function properties() {

            $properties = array();
            foreach (static::$dbFields  as $dbField) {
                if(property_exists($this, $dbField)) {
                    $properties[$dbField] = $this->$dbField;
                }   
            }
            return $properties;
        }

        /**
         * if object id is not set save the object to database
         * if object id is set update the object
         */
        public function save() {
            if(!$this->id) {
                $this->create();
            } else {
                $this->updateRow();
            }
        }


        /**
         * Create new row in database
         * getting static object properties
         * inserting in database table 
         *
         * @return void
         */
        public function create() {
            try 
            {
                $properties = $this->properties();
                $database = Database::instance();
                $connection = $database->connect();
                $placeholders = implode(',:', array_keys($properties));
                $placeholders = ':' . $placeholders;
                $sql = "INSERT INTO " . static:: $dbTable . " (" . implode(', ', array_keys($properties)) . ") VALUES (" . $placeholders . ")";
                $stmt = $connection->prepare($sql);
                $stmt->execute($properties);
                $this->id = $connection->lastInsertId();
                return;
            } 
            catch (PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }
            
        }

        /**
         * updating database table row
         * removing last item from object properties, should be foreign key
         * if updating object with no foreign key insert if statement before array_pop
         *
         * @return void
         */
        public function updateRow() {
            try 
            {
                $properties = $this->properties();
                // remove last element from array, foreign key
                array_pop($properties);
                if(static::$dbTable == 'artikal') {
                    array_pop($properties);
                }
                $database = Database::instance();
                $connection = $database->connect();
                $placeholders = str_repeat('?, ', count($properties) - 1) . '?';
                
                $properties_pairs = array();
                foreach ($properties as $key => $value) {
                    $properties_pairs[] = "{$key}=:{$key}";
                }

                $sql = "UPDATE " . static:: $dbTable . " SET " . implode(',', $properties_pairs) . " WHERE id=:id";
                $stmt = $connection->prepare($sql);
                $properties['id'] = $this->id;
                $stmt->execute($properties);
                return;
            }
            catch (PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }
        }


        /**
         * find element from database where id is equal to provided id param
         *
         * @param [int] $id
         * @return array
         */
        public static function findById($id) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();

                $sql = "SELECT * FROM " . static::$dbTable . " WHERE id = ?;";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e) 
            {
                echo $e->getMessage();
                Message::addError('error', $e->getMessage());
            }
        }

        /**
         * select everything from database table where
         * provided placeholder parameter is equal to provided id parameter
         *
         * @param [string] $placeholder
         * @param [mixed] $id
         * @return array
         */
        public static function findAllByQuery($placeholder,  $id, $order = 'ASC') {
            try 
            {
                if(!in_array($order, array('ASC', 'DESC'))) {
                    exit();
                }
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "SELECT * FROM " . static::$dbTable . " WHERE $placeholder = ? ORDER BY id $order;";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }

        }

        /**
         * Get element from database table where all three placeholders match provided argument values
         *
         * @param [string] $placeholder
         * @param [mixed] $id
         * @param [string] $placeholder2
         * @param [mixed] $id2
         * @param [string] $placeholder3
         * @param [mixed] $id3
         * @return array
         */
        public static function findAllByQuery3($placeholder,  $id, $placeholder2, $id2, $placeholder3, $id3) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "SELECT * FROM " . static::$dbTable . " WHERE $placeholder = ? AND $placeholder2 = ? AND $placeholder3 = ?;";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->bindParam('2', $id2);
                $stmt->bindParam('3', $id3);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }

        }
        
        /**
         * Get element from database table where both placeholders match provided values
         *
         * @param [string] $placeholder
         * @param [mixed] $id
         * @param [string] $placeholder2
         * @param [mixed] $id2
         * @return array
         */
        public static function findAllByQuery2($placeholder,  $id, $placeholder2, $id2) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "SELECT * FROM " . static::$dbTable . " WHERE $placeholder = ? AND $placeholder2 = ?;";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->bindParam('2', $id2);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }

        }

        /**
         * Delete one element from database table where id is equal to class
         * instance id
         *
         * @return void
         */
        public function delete() {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "DELETE FROM " . static::$dbTable . " WHERE id = ?";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $this->id);
                $stmt->execute();
                return;
            } 
            catch(PDOException $e) 
            {
                Message::addError( 'error', $e->getMessage());
            }
        }


        /**
         * Get number of selected rows
         *
         * @param [string] $placeholder
         * @param [mixed] $id
         * @return int
         */ 
        public static function countRows($placeholder, $id) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "SELECT COUNT(*) FROM " . static::$dbTable . " WHERE $placeholder = ?;";
                $stmt = $connection->prepare($sql);
                $stmt->bindParam('1', $id);
                $stmt->execute();
                $rows = $stmt->fetchColumn();
                return $rows;
            }
            catch(PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }

        }


        public static function findAllWithOffset($placeholder, $id, $limit, $offset) {
            try 
            {
                $database = Database::instance();
                $connection = $database->connect();
                $sql = "SELECT * FROM " . static::$dbTable . " WHERE $placeholder=:id ORDER BY id DESC LIMIT :limit OFFSET :offset;";
                $stmt = $connection->prepare($sql);
                $stmt->bindValue(':id', $id);
                $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            }
            catch(PDOException $e)
            {
                Message::addError('error', $e->getMessage());
            }

        }

        /**
         * return class instance id
         *
         * @return int
         */
        public function getId() {
            return $this->id;
        }

    } //end of class
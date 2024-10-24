<?php
use PHPUnit\Framework\TestCase;
if (!file_exists(__DIR__ . '/../app/registrar_movimientos.php')) {
    die('El archivo registrar_movimientos.php no se encontró en la ruta especificada.');
}
require_once __DIR__ . '/../app/registrar_movimientos.php';

class RegistrarMovimientosTest extends TestCase {
    private $conn;

    protected function setUp(): void {
        $this->conn = $this->createMock(mysqli::class);
    }

    public function testRegistrarRetiroExitoso() {
        $stmt = $this->createMock(mysqli_stmt::class);
        $stmt->method('bind_param')->willReturn(true);
        $stmt->method('execute')->willReturn(true);
        
        $this->conn->method('prepare')->willReturn($stmt);

        $result = registrarRetiro($this->conn, 100, 1);
        $this->assertTrue($result);
    }

    public function testRegistrarDepositoExitoso() {
        $stmt = $this->createMock(mysqli_stmt::class);
        $stmt->method('bind_param')->willReturn(true);
        $stmt->method('execute')->willReturn(true);
        
        $this->conn->method('prepare')->willReturn($stmt);

        $result = registrarDeposito($this->conn, 100, 1);
        $this->assertTrue($result);
    }

    public function testRegistrarRetiroFallaEnInsercion() {
        $this->conn->method('prepare')->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Error en la consulta de inserción");
        
        registrarRetiro($this->conn, 100, 1);
    }

    public function testRegistrarDepositoFallaEnInsercion() {
        $this->conn->method('prepare')->willReturn(false);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Error en la consulta de inserción");
        
        registrarDeposito($this->conn, 100, 1);
    }
}

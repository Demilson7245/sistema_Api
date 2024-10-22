# Documentación de la API del Sistema de Gestión Médica

# Integrantes: 
##Demilson Calivar Pizarro
##Yoel Cristian Quispe Diaz

## Descripción
Esta API permite gestionar pacientes, médicos y citas a través de endpoints RESTful.

## Base URL
`http://localhost/api_medica/`

## Instalación

1. **Requisitos Previos:**
   - Tener instalado PHP (versión 7.4 o superior).
   - Tener instalado un servidor web (como Apache o Nginx).
   - Tener acceso a una base de datos (MySQL, PostgreSQL, etc.).
   - Asegúrate de que los módulos de PHP requeridos estén habilitados (como PDO).

2. **Clonar el repositorio:**
   ```bash
   git clone <URL_DEL_REPOSITORIO>
   ```

3. **Navegar al directorio del proyecto:**
   ```bash
   cd api_medica
   ```

4. **Configurar la base de datos:**
   - Crear una base de datos en tu gestor de base de datos.
   - Importar las tablas necesarias desde un archivo SQL que puedes incluir en el proyecto.

5. **Configurar las credenciales de la base de datos:**
   - Edita el archivo de configuración (por ejemplo, `config.php`) y agrega tus credenciales de base de datos.

6. **Instalar dependencias:**
   - Si usas Composer, ejecuta:
   ```bash
   composer install
   ```

## Ejecución

1. **Iniciar el servidor:**
   Si estás utilizando PHP's built-in server, ejecuta el siguiente comando en la raíz del proyecto:
   ```bash
   php -S localhost:8000
   ```
   Luego, accede a la API desde tu navegador o herramientas como Postman en `http://localhost:8000/api_medica/`.


2. **Probar los endpoints:**
   Utiliza herramientas como Postman o cURL para probar los siguientes endpoints:

### 1. API de Pacientes

#### 1.1 Listar todos los pacientes
- **URL:** `http://localhost/api_medica/pacientes/`
- **Método:** GET
- **Descripción:** Obtiene una lista de todos los pacientes.

#### 1.2 Obtener un paciente específico
- **URL:** `http://localhost/api_medica/pacientes/{id}`
- **Método:** GET
- **Parámetros de URL:** id (ID del paciente)

#### 1.3 Crear un nuevo paciente
- **URL:** `http://localhost/api_medica/pacientes/`
- **Método:** POST
- **Datos del cuerpo:**
```json
{
  "nombre": "Ana",
  "apellido": "Martínez",
  "fecha_nacimiento": "1995-03-10",
  "direccion": "Plaza 789, Villa",
  "telefono": "5555555555",
  "correo": "ana.martinez@email.com"
}
```

#### 1.4 Actualizar un paciente existente
- **URL:** `http://localhost/api_medica/pacientes/{id}`
- **Método:** PUT
- **Datos del cuerpo:**
```json
{
  "nombre": "Juan",
  "apellido": "Pérez",
  "fecha_nacimiento": "1990-05-15",
  "direccion": "Nueva Calle 456, Ciudad",
  "telefono": "9999999999",
  "correo": "juan.perez.nuevo@email.com"
}
```

#### 1.5 Eliminar un paciente
- **URL:** `http://localhost/api_medica/pacientes/{id}`
- **Método:** DELETE

### 2. API de Médicos

#### 2.1 Listar todos los médicos
- **URL:** `http://localhost/api_medica/medicos/`
- **Método:** GET

#### 2.2 Autenticar médico
- **URL:** `http://localhost/api_medica/medicos/auth`
- **Método:** POST
- **Datos del cuerpo:**
```json
{
  "username": "carlosrod",
<<<<<<< HEAD
  "password": "contraseña123"
=======
  "password": "12345"
>>>>>>> feb33af0bd0c80907a04a1907dc9fd415e927699
}
```

#### 2.3 Obtener un médico específico
- **URL:** `http://localhost/api_medica/medicos/{id}`
- **Método:** GET

#### 2.4 Crear un nuevo médico
- **URL:** `http://localhost/api_medica/medicos/`
- **Método:** POST
- **Datos del cuerpo:**
```json
{
  "nombre": "Elena",
  "apellido": "Sánchez",
  "especialidad": "Neurología",
  "telefono": "7778889999",
  "correo": "elena.sanchez@hospital.com",
  "username": "elenasan",
<<<<<<< HEAD
  "password": "contraseña456"
=======
  "password": "12345"
>>>>>>> feb33af0bd0c80907a04a1907dc9fd415e927699
}
```

#### 2.5 Actualizar un médico existente
- **URL:** `http://localhost/api_medica/medicos/{id}`
- **Método:** PUT
- **Datos del cuerpo:**
```json
{
  "nombre": "Carlos",
  "apellido": "Rodríguez",
  "especialidad": "Cardiología",
  "telefono": "9990001111",
  "correo": "carlos.rodriguez.nuevo@hospital.com",
  "username": "carlosrod",
  "password": "12345"
}
```

#### 2.6 Eliminar un médico
- **URL:** `http://localhost/api_medica/medicos/{id}`
- **Método:** DELETE

### 3. API de Citas

#### 3.1 Listar todas las citas
- **URL:** `http://localhost/api_medica/citas/`
- **Método:** GET

#### 3.2 Obtener una cita específica
- **URL:** `http://localhost/api_medica/citas/{id}`
- **Método:** GET

#### 3.3 Crear una nueva cita
- **URL:** `http://localhost/api_medica/citas/`
- **Método:** POST
- **Datos del cuerpo:**
```json
{
  "paciente_id": 3,
  "medico_id": 1,
  "fecha_hora": "2023-06-01 11:00:00",
  "motivo": "Primera consulta",
  "estado": "Programada"
}
```

#### 3.4 Actualizar una cita existente
- **URL:** `http://localhost/api_medica/citas/{id}`
- **Método:** PUT
- **Datos del cuerpo:**
```json
{
  "paciente_id": 1,
  "medico_id": 2,
  "fecha_hora": "2023-05-20 11:00:00",
  "motivo": "Consulta rutinaria (horario actualizado)",
  "estado": "Confirmada"
}
```

#### 3.5 Eliminar una cita
- **URL:** `http://localhost/api_medica/citas/{id}`
- **Método:** DELETE

## Notas Adicionales
- Todos los endpoints devuelven un código de estado 404 si el recurso solicitado no se encuentra.
- Los errores del servidor devuelven un código de estado 500.

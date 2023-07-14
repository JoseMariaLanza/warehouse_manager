# Módulo de Turnos
## _Shifts_

El módulo de turnos funciona de manera distinta al de cuenta de usuarios ya que pasa primero por dos middlewares antes de decidir si el usuario que intenta ingresar en una ruta está autorizado o no a acceder a dicho módulo.

### Funcionamiento de middleware plan.modules (`JWTAuthAcquiredPlanMiddleware.php`)
_Parámetros_: <NombreModulo>
`'plan.modules:Shifts'`
Antes de dejar pasar la solicitud este middleware consulta una DB externa que tiene un registro de los clientes que contrataron un plan. Cada plan se compone de varios módulos, por lo que si el usuario intenta acceder a un módulo que no pertenece al plan, el acceso a éste será rechazado.
En caso de no ser rechazado, el flujo de la información pasará al siguiente middleware (`modules.roles`)

### Funcionamiento de middleware module.roles (`AuthShiftRolesMiddleware.php`)
_Parámetros_: <NombreModulo>
`'module.roles:Shifts'`
Como el nombre lo indica, éste módulo se encarga de comprobar el acceso al módulo mediante el o los roles del usuario.

## Rutas
1. _**{url}/shifts/v1/**_ (Get all Shifts)
2. _**{url}/shifts/v1/**_ (Get all Filtered Shifts)
3. _**{url}/shifts/v1/create-shift**_ (Create Shift)
4. _**{url}/shifts/v1/update-shift**_ (Update Shift)

_**Importar y consultar Json de Postman y su documentación para más detalles**_

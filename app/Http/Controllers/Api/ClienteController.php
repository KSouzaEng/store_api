<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Telefone;
use App\Models\TipoCliente;
use App\Models\VendedorCliente;
use App\Models\Imagem;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewClient;
use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function registerCliente(ClienteRequest $request){

        try{
            $input = $request->validated();

            $name = $request['imagem']->getClientOriginalName();

            $path = $request['imagem']->store('public/clientes');
            $id = Auth::id();

            $cliente = Cliente::create([

                'name' => $input['name'],
                'email' => $input['email'],
                'imagem' => $path
            ]);

            if(!$cliente){

                return response()->json(['error' => 'Não foi possível registrar o usuario'], 400);
              }else{

                $vendeor_cliente = VendedorCliente::create([
                    'vendedor_id' => $id,
                    'cliente_id' => $cliente->id

                ]);
                    $telefone = Telefone::create([

                        'telefone1' => $input['telefone1'],
                        'telefone2' => $input['telefone2'],
                        'cliente_id' => $cliente->id

                    ]);
                    $tipo_cliente = TipoCliente::create([

                        'tipo_pessoa' => $input['tipo_pessoa'],
                        'cliente_id' => $cliente->id

                    ]);


                        Notification::route('mail', config('mail.from.address'))
                        ->notify(new NewClient($cliente));


                    return response()->json(['success' =>  $cliente], 200);

              }

          }catch(Exception $e){
              return response()->json(['error' => $e]);
          }

    }
    public function search($name){

        try {
            $cliente = Cliente::where('name','like','%'.$name.'%')->with('telefone','tipocliente','vendedor')->get();
            if(!$cliente){

                return response()->json(['error' => 'Não foi possível encontrar o cliente'], 400);
              }else{
                return response()->json(['sucssess' =>  $cliente], 200);
              }
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
    public function updateCliente(ClienteRequest $request,$id){


        try {
            $input = $request->validated();

            return response()->json(['sucssess' =>  $input], 200);
            $name = $request['imagem']->getClientOriginalName();

            $path = $request['imagem']->store('public/clientes');

            $cliente = Cliente::where('id',$id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'imagem' => $path,
            ]);

          if(!$cliente){

            return response()->json(['error' => 'Não foi possível atualizar os dados do usuario'], 400);
          }else{
            $telefone = Telefone::where('cliente_id', $cliente->id)->update([

                'telefone1' => $request->telefone1,
                'telefone2' => $request->telefone2,
                // 'cliente_id' => $cliente->id

            ]);
            $tipo_cliente = TipoCliente::where('cliente_id', $cliente->id)->update([

                'tipo_pessoa' => $request->tipo_pessoa,
                // 'cliente_id' => $cliente->id

            ]);
            return response()->json(['sucssess' =>  $cliente,'telefone',$telefone,'tipo_cliente' => $tipo_cliente], 200);
          }
        } catch (Exception $e) {
            return response()->json(['error' => $e]);
        }
    }
    public function destroy($id){
        try {

            $cliente = Cliente::where('id','=',$id);

            $cliente->delete();

            if(!$cliente){

                 return response()->json(['error' => 'Não foi possível deletar o usuario'], 400);

            }else{
                return response()->json(['sucssess' =>  $cliente], 200);

            }


        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['error' => $e->errorInfo], 500);
        }
            // $rel
    }

}

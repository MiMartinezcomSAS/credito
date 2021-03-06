<?php namespace credits\Managers;
use credits\Entities\User;
use Carbon\Carbon;

class UploadUserManager extends BaseManager
{

    public function getRules()
    {
        $rules=[
            'identification_card'       => 'required|unique:users,identification_card,'.$this->data["id"].'',
            'name'                      => 'required',
            'last_name'                 => 'required',
            'user_name'                 => 'required|unique:users,user_name,'.$this->data["id"].'',
            'email'                     => 'email|unique:users,email,'.$this->data["id"].'',
            'address'                   => 'required',
            'residency_city'            => 'required',
            'birth_city'                => 'required',
            'mobile_phone'              => 'required|numeric|digits_between:6,11',
            'phone'                     => 'required|numeric|digits_between:6,11',
            'date_birth'                => 'required',
            'location'                  => 'required|numeric',
            'card'                      => 'numeric'


        ];
        return  $rules;
    }

    public function getMessage()
    {
        $messages = [
            'required'          => 'El campo  es obligatorio.',
            'email'             => 'El correo esta mal escrito',
            'same'              => 'Las contraseñas deben ser iguales',
            'unique'            => 'El campo ya se encuentra registrado',
            'digits_between'   => 'El campo debe ser entre 6 a 11 digitos',
            'numeric'           => 'El campo va en numeros'
        ];
        return $messages;
    }

    public function uploadUser($id,$role)
    {
        $data=$this->prepareData($this->data);
        $user=User::find($id);
        $file=$data['photo'];
        if($file)
        {
            $data["photo"]=sha1(time()).$file->getClientOriginalName();
            $file->move("users",sha1(time()).$file->getClientOriginalName());
        }else{
            $data["photo"]=$user->photo;
        }
        if($role==4)
        {
            if($this->date($user->updated_at))
            {
                $user->update($data);
                return true;
            }
            return false;
        }else{
            $user->update($data);
            return true;
        }



    }

    public function date($date)
    {
        $created = new Carbon($date);
        $now = Carbon::now();
        $difference = ($created->diff($now)->days < 1)
            ? 'today'
            : $created->diffForHumans($now);
        $dates=explode(" ",$difference);
        if(count($dates)>1)
        {
            if($dates[1]=="month" or $dates[1]=="months" )
            {
                if($dates[0]>=1)
                {
                    return true;
                }
            }else{
                return false;
            }
        }
        return false;
        //echo $date->timespan();  // zondag 28 april 2013 21:58:16
    }


}